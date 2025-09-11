<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Chat;
use App\Models\Message;

class GeminiService
{
    protected $apiKey;
    protected $apiUrl = 'https://generativelanguage.googleapis.com/v1/models/gemini-2.5-pro:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
    }

    /**
     * Send a message to the Gemini API and get a response
     *
     * @param string $message The user's message
     * @param Chat $chat The chat instance
     * @return array Response with message content and status
     */
    public function sendMessage(string $message, Chat $chat)
    {
        try {

            // Check for identity question
            // $message = $message . " write something that don't be over two lines";
            if ($this->isIdentityQuestion($message)) {
                return [
                    'content' => "Informa-team chatbot support.",
                    'needs_human_support' => false
                ];
            }

            // Prepare the request payload
            $payload = [
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [
                            ['text' => $message]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'topK' => 40,
                    'topP' => 0.95,
                    // 'maxOutputTokens' => 60,
                ]
            ];

            // Send request to Gemini API
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post($this->apiUrl . '?key=' . $this->apiKey, $payload);


            // Process the response
            Log::info('Gemini API Response Status: ' . $response);
            Log::info('Gemini API Request: ' . json_encode($payload));
            Log::info('Gemini API Response Status: ' . $response->status());
            if ($response->successful()) {
                $responseData = $response->json();
                $botResponse = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'عذراً، لم أتمكن من إنشاء استجابة.';

                // Check if the bot needs human support
                $needsHumanSupport = $this->needsHumanSupport($message, $botResponse);

                return [
                    'content' => $botResponse,
                    'needs_human_support' => $needsHumanSupport
                ];
            } else {
                $statusCode = $response->status();
                $errorBody = $response->body();
                Log::error('Gemini API error: Status Code: ' . $statusCode . ', Response: ' . $errorBody);

                $errorMessage = 'عذراً، حدث خطأ. يرجى المحاولة مرة أخرى لاحقاً.';
                if ($statusCode == 404) {
                    $errorMessage = 'عذراً، خدمة Gemini غير متوفرة حالياً. يرجى المحاولة مرة أخرى لاحقاً.';
                } elseif ($statusCode >= 500) {
                    $errorMessage = 'عذراً، خدمة Gemini تواجه مشاكل. يرجى المحاولة مرة أخرى لاحقاً.';
                }

                return [
                    'content' => $errorMessage,
                    'needs_human_support' => true
                ];
            }
        } catch (\Exception $e) {
            Log::error('Exception in GeminiService: ' . $e->getMessage());
            return [
                'content' => 'عذراً، حدث خطأ. يرجى المحاولة مرة أخرى لاحقاً.',
                'needs_human_support' => true
            ];
        }
    }

    /**
     * Check if the message is related to technical support
     *
     * @param string $message
     * @return bool
     */
    private function isTechnicalSupportQuery(string $message)
    {
        // Simple keyword-based check for technical support queries
        $technicalKeywords = [
            'help',
            'problem',
            'issue',
            'error',
            'bug',
            'not working',
            'broken',
            'how to',
            'how do I',
            'can\'t',
            'doesn\'t work',
            'fix',
            'trouble',
            'support',
            'technical',
            'assistance',
            'guide',
            'tutorial'
        ];

        $message = strtolower($message);

        foreach ($technicalKeywords as $keyword) {
            if (str_contains($message, $keyword)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the message is asking about the chatbot's identity
     *
     * @param string $message
     * @return bool
     */
    private function isIdentityQuestion(string $message)
    {
        $identityQuestions = [
            'who are you',
            'what are you',
            'your name',
            'who is this',
            'what is your name',
            'who am I talking to',
            'are you a bot',
            'are you human',
            'are you ai'
        ];

        $message = strtolower($message);

        foreach ($identityQuestions as $question) {
            if (str_contains($message, $question)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if the conversation needs human support
     *
     * @param string $userMessage
     * @param string $botResponse
     * @return bool
     */
    private function needsHumanSupport(string $userMessage, string $botResponse)
    {
        // Check for indicators that the bot cannot solve the problem
        $escalationKeywords = [
            'I don\'t know',
            'I\'m not sure',
            'I can\'t help',
            'beyond my capabilities',
            'I don\'t understand',
            'I\'m unable to',
            'I cannot',
            'contact support',
            'human assistance',
            'speak to a representative',
            'talk to a human',
            'complex issue',
            'need more information'
        ];

        // Check if the bot's response contains any escalation keywords
        foreach ($escalationKeywords as $keyword) {
            if (str_contains(strtolower($botResponse), strtolower($keyword))) {
                return true;
            }
        }

        // Check for repeated questions or frustration indicators in user message
        $frustrationKeywords = [
            'you\'re not helping',
            'this is useless',
            'not what I asked',
            'you don\'t understand',
            'I already tried that',
            'that doesn\'t work',
            'I need a real person',
            'I need a human',
            'talk to someone else',
            'this is frustrating',
            'speak with agent',
            'talk to agent',
            'connect me',
            'human support',
            'real person'
        ];

        foreach ($frustrationKeywords as $keyword) {
            if (str_contains(strtolower($userMessage), strtolower($keyword))) {
                return true;
            }
        }

        // Check for complex technical issues that likely need human intervention
        $complexIssueKeywords = [
            'error code',
            'system crash',
            'keeps freezing',
            'data loss',
            'security breach',
            'account locked',
            'payment issue',
            'refund request'
        ];

        foreach ($complexIssueKeywords as $keyword) {
            if (str_contains(strtolower($userMessage), strtolower($keyword))) {
                return true;
            }
        }

        return false;
    }
}
