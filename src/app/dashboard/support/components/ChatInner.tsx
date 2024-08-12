import { FC, useState, useEffect, useRef } from "react";
import clsx from "clsx";
import {
  toAbsoluteUrl,
  defaultMessages,
  defaultUserInfos,
  MessageModel,
  UserInfoModel,
  messageFromClient,
} from "../../../../_metronic/helpers";
import {
  getChat,
  createMessage,
  getMessages,
  getChatMessages,
  uploadImage,
} from "../core/_requests";
import { KTIcon } from "../../../../_metronic/helpers";

type Props = {
  isDrawer?: boolean;
  selectedChat?: any; // Update this to match the type of selectedChat
};

const bufferMessages = defaultMessages;

const ChatInner: FC<Props> = ({ isDrawer = false, selectedChat }) => {
  const [message, setMessage] = useState<string>("");
  const [messages, setMessages] = useState<MessageModel[]>([]);
  const [userInfos] = useState<UserInfoModel[]>(defaultUserInfos);
  const [chat, setChat] = useState({});
  const [selectedImage, setSelectedImage] = useState<File | null>(null);
  const fileInputRef = useRef<HTMLInputElement>(null);

  const sendMessage = async () => {
    if (!message.trim() && !selectedImage) {
      return;
    }

    let newMessage: MessageModel = {
      user: 2,
      type: "in",
      text: message,
      time: "Just now",
      path: "",
    };

    const formData = new FormData();
    if (selectedImage) {
      formData.append("file", selectedImage);
    }

    const response = await createMessage(
      message,
      "in",
      selectedChat.user.id,
      selectedImage
    );
    console.log(response);

    newMessage.text = message;
    bufferMessages.push(newMessage);
    setMessage("");
    setSelectedImage(null);
    getMessageList();
  };

  const onEnterPress = (e: React.KeyboardEvent<HTMLTextAreaElement>) => {
    if (e.keyCode === 13 && e.shiftKey === false) {
      e.preventDefault();
      sendMessage();
    }
  };

  const getMessageList = async () => {
    if (!selectedChat) return;

    const response = await getChatMessages(selectedChat.id); // Assuming `getMessages` can take an ID
    console.log(response.message);

    setMessages(response.message);
  };

  useEffect(() => {
    if (selectedChat) {
      getMessageList();
    }
  }, [selectedChat]);

  return (
    <div
      className="card-body p-5"
      id={isDrawer ? "kt_drawer_chat_messenger_body" : "kt_chat_messenger_body"}
    >
      <div
        className={clsx("scroll-y me-n5 pe-5", {
          "h-300px h-lg-auto": !isDrawer,
        })}
        data-kt-element="messages"
        data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}"
        data-kt-scroll-max-height="auto"
        data-kt-scroll-dependencies={
          isDrawer
            ? "#kt_drawer_chat_messenger_header, #kt_drawer_chat_messenger_footer"
            : "#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer"
        }
        data-kt-scroll-wrappers={
          isDrawer
            ? "#kt_drawer_chat_messenger_body"
            : "#kt_content, #kt_app_content, #kt_chat_messenger_body"
        }
        data-kt-scroll-offset={isDrawer ? "0px" : "5px"}
        style={{
          minHeight: isDrawer ? "calc(100vh - 210px)" : "calc(100vh - 340px)",
          overflow: "scroll",
        }}
      >
        {messages.map((message, index) => {
          const userInfo = userInfos[message.user];
          const state = message.type === "out" ? "info" : "primary";
          const templateAttr = {};
          if (message.template) {
            Object.defineProperty(templateAttr, "data-kt-element", {
              value: `template-${message.type}`,
            });
          }
          const contentClass = `${isDrawer ? "" : "d-flex"} justify-content-${
            message.type === "out" ? "start" : "end"
          } mb-10`;
          return (
            <div
              key={`message${index}`}
              className={clsx("d-flex", contentClass, "mb-10", {
                "d-none": message.template,
              })}
              {...templateAttr}
            >
              <div
                className={clsx(
                  "d-flex flex-column align-items",
                  `align-items-${message.type === "out" ? "start" : "end"}`
                )}
              >
                <div className="d-flex align-items-center mb-2">
                  {message.type === "out" ? (
                    <>
                      <div className="symbol  symbol-35px symbol-circle ">
                        {/* <img
                          alt="Pic"
                          src={toAbsoluteUrl(`media/${userInfo.avatar}`)}
                        /> */}
                      </div>
                      <div className="ms-3">
                        <a
                          href="#"
                          className="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"
                        >
                          {selectedChat?.user?.name}
                        </a>
                        {/* <span className="text-muted fs-7 mb-1">
                          {message.time}
                        </span> */}
                      </div>
                    </>
                  ) : (
                    <>
                      <div className="me-3">
                        {/* <span className="text-muted fs-7 mb-1">
                          {message.time}
                        </span> */}
                        <a
                          href="#"
                          className="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1"
                        >
                          You
                        </a>
                      </div>
                      <div className="symbol  symbol-35px symbol-circle ">
                        {/* <img
                          alt="Pic"
                          src={toAbsoluteUrl(`media/${userInfo.avatar}`)}
                        /> */}
                      </div>
                    </>
                  )}
                </div>

                <div
                  className={clsx(
                    "p-5 rounded",
                    `bg-light-${state}`,
                    "text-gray-900 fw-bold mw-lg-400px",
                    `text-${message.type === "out" ? "start" : "end"}`
                  )}
                  data-kt-element="message-text"
                  dangerouslySetInnerHTML={{
                    __html: message!.text,
                  }}
                ></div>
                <div
                  className="px-2"
                  style={{
                    alignSelf: "self-end",
                  }}
                >
                  {message.path && (
                    <a href={message.path} target="_blank">
                      Attachment
                    </a>
                  )}
                </div>
              </div>
            </div>
          );
        })}
      </div>

      <div
        className="card-footer"
        id={
          isDrawer
            ? "kt_drawer_chat_messenger_footer"
            : "kt_chat_messenger_footer"
        }
        style={{
          padding: "0",
        }}
      >
        <textarea
          className="form-control form-control-flush mb-3"
          rows={1}
          data-kt-element="input"
          placeholder="Type a message"
          value={message}
          onChange={(e) => setMessage(e.target.value)}
          onKeyDown={onEnterPress}
        ></textarea>

        <div className="d-flex flex-stack">
          <div className="d-flex align-items-center me-2">
            <input
              type="file"
              accept="image/*"
              onChange={(e) => {
                if (e.target.files && e.target.files[0]) {
                  setSelectedImage(e.target.files[0]);
                }
              }}
              style={{ display: "none" }}
              ref={fileInputRef}
            />
            <button
              className="btn btn-sm btn-icon btn-active-light-primary me-1"
              type="button"
              onClick={() => {
                if (fileInputRef.current) {
                  fileInputRef.current.click();
                }
              }}
            >
              <i className="bi bi-upload fs-3"></i>
            </button>
          </div>
          <button
            className="btn btn-primary"
            type="button"
            data-kt-element="send"
            onClick={sendMessage}
          >
            Send
          </button>
        </div>
      </div>
    </div>
  );
};

export { ChatInner };
