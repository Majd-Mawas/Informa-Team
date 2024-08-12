import { useState, useEffect } from "react";
import { getChats } from "./core/_requests";
import { KTIcon } from "../../../_metronic/helpers";
import { ChatInner } from "./components/ChatInner";
import "./components/ChatInner.css";

export function SupportAdmin() {
  interface Support {
    id: number; // Assuming there's an ID for each chat
    title: string;
    user: User;
  }

  interface User {
    name: string;
    email: string;
  }

  const [supports, setSupports] = useState<Support[]>([]);
  const [selectedChat, setSelectedChat] = useState<Support | null>(null);

  useEffect(() => {
    const getSupportsList = async () => {
      const response = await getChats();
      setSupports(response.chats);
    };

    getSupportsList();
  }, []);

  const handleChatSelection = (support: Support) => {
    setSelectedChat(support);
  };

  return (
    <>
      <div className="d-flex flex-column flex-lg-row">
        <div className="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
          <div className="card card-flush">
            <div className="card-header pt-7" id="kt_chat_contacts_header">
              <form className="w-100 position-relative" autoComplete="off">
                <KTIcon
                  iconName="magnifier"
                  className="fs-2 text-lg-1 text-gray-500 position-absolute top-50 ms-5 translate-middle-y"
                />
                <input
                  type="text"
                  className="form-control form-control-solid px-15"
                  name="search"
                  placeholder="Search by username or email..."
                />
              </form>
            </div>

            <div className="card-body pt-5" id="kt_chat_contacts_body">
              <div
                className="scroll-y me-n5 pe-5 h-200px h-lg-auto"
                data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}"
                data-kt-scroll-max-height="auto"
                data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_contacts_header"
                data-kt-scroll-wrappers="#kt_content, #kt_chat_contacts_body"
                data-kt-scroll-offset="0px"
              >
                {supports.map((support, index) => (
                  <div key={index}>
                    <div
                      className="d-flex flex-stack py-4"
                      onClick={() => handleChatSelection(support)}
                      style={{ cursor: "pointer" }}
                    >
                      <div className="d-flex align-items-center">
                        <div className="symbol symbol-45px symbol-circle">
                          <span className="symbol-label bg-light-danger text-danger fs-6 fw-bolder">
                            {support.user.name[0] ?? ""}
                          </span>
                        </div>

                        <div className="ms-5">
                          <a
                            href="#"
                            className="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2"
                          >
                            {support.user.name ?? ""}
                          </a>
                          <div className="fw-bold text-gray-500">
                            {support.user.email ?? ""}
                          </div>
                        </div>
                      </div>
                    </div>

                    <div className="separator separator-dashed d-none"></div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>

        <div className="flex-lg-row-fluid ms-lg-7 ms-xl-10">
          <div className="card" id="kt_chat_messenger">
            <div className="card-header" id="kt_chat_messenger_header">
              <div className="card-title">
                <div className="symbol-group symbol-hover"></div>
                <div className="d-flex justify-content-center flex-column me-3">
                  <a
                    href="#"
                    className="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1"
                  >
                    {selectedChat?.user.name ?? "Select a chat"}
                  </a>
                  {selectedChat && (
                    <div className="mb-0 lh-1">
                      <span className="badge badge-success badge-circle w-10px h-10px me-1"></span>
                      <span className="fs-7 fw-bold text-gray-500">
                        {selectedChat ? "Active" : ""}
                      </span>
                    </div>
                  )}
                </div>
              </div>
            </div>

            {selectedChat ? (
              <ChatInner selectedChat={selectedChat} />
            ) : (
              <div
                className="d-flex flex-column align-items-center justify-content-center h-100"
                style={{ minHeight: "70vh" }}
              >
                <KTIcon iconName="chat" className="fs-3x text-gray-500 mb-5" />
                <h3 className="text-gray-500">No chat selected</h3>
                <p className="text-gray-500">
                  Please select a chat from the list to view the conversation.
                </p>
              </div>
            )}
          </div>
        </div>
      </div>
    </>
  );
}
