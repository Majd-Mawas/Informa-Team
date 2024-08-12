import axios, { AxiosResponse } from "axios";
import { ID, Response } from "../../../../_metronic/helpers";

const API_URL = import.meta.env.VITE_APP_API_URL;
const CHAT_URL = `${API_URL}/chats`;
const MESSAGE_URL = `${API_URL}/messages`;
const CHAT_MESSAGE_URL = `${API_URL}/chats/messages`;
const CHAT_MESSAGE_URL2 = `${API_URL}/chats/message`;

const getChat = async () => {
  return axios
    .get(CHAT_URL)
    .then((response: AxiosResponse) => {
      return response.data; // Ensure you are returning the data from the response
    })
    .catch((error) => {
      console.error("Error fetching", error);
      throw error; // Re-throw the error to handle it in the calling function
    });
};

const getChats = async () => {
  return axios
    .get(CHAT_URL +"/all")
    .then((response: AxiosResponse) => {
      return response.data; // Ensure you are returning the data from the response
    })
    .catch((error) => {
      console.error("Error fetching", error);
      throw error; // Re-throw the error to handle it in the calling function
    });
};

const getMessages = async () => {
  return axios
    .get(CHAT_MESSAGE_URL)
    .then((response: AxiosResponse) => {
      return response.data; // Ensure you are returning the data from the response
    })
    .catch((error) => {
      console.error("Error fetching", error);
      throw error; // Re-throw the error to handle it in the calling function
    });
};
const getChatMessages = async (chat_id:number) => {
  return axios
    .post(CHAT_MESSAGE_URL2,{chat_id})
    .then((response: AxiosResponse) => {
      return response.data; // Ensure you are returning the data from the response
    })
    .catch((error) => {
      console.error("Error fetching", error);
      throw error; // Re-throw the error to handle it in the calling function
    });
};
const createMessage = async (body:string,type:string,user_id:number,formData:any) => {
  return axios
    .post(MESSAGE_URL,{
      body,
      type,
      user_id,
      file:formData
    },{
      headers: {
        'Content-Type': 'multipart/form-data', // Set the Content-Type to multipart/form-data
      },
    })
    .then((response: AxiosResponse) => {
      return response.data; // Ensure you are returning the data from the response
    })
    .catch((error) => {
      console.error("Error fetching", error);
      throw error; // Re-throw the error to handle it in the calling function
    });
};

const uploadImage = async (formData: FormData) => {
  try {
    const response = await fetch('/upload-image-endpoint', {
      method: 'POST',
      body: formData,
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error uploading image:', error);
    return { success: false };
  }
};

export {
  getChat,
  getChats,
  getChatMessages,
  createMessage,
  getMessages,
  uploadImage
};
