import { Content } from "../../../_metronic/layout/components/content";
import { useState, useEffect } from "react";
import { getChat } from "./core/_requests";
import { ToolbarWrapper } from "../../../_metronic/layout/components/toolbar";
import { KTIcon, toAbsoluteUrl } from "../../../_metronic/helpers";
// import { ChatInner, Dropdown1 } from "../../../_metronic/partials";
import { ChatInner } from "./components/ChatInner";
import "./components/ChatInner.css";

export function Support() {
  interface Program {
    name: string;
    released_at: string;
    category_name: string;
    telegram_link: string;
    youtube_link: string;
  }

  const [supports, setSupports] = useState<Program[]>([]);
  const [selectedCategory, setSelectedCategory] = useState<string>("All");

  useEffect(() => {
    const getSupportsList = async () => {
      const response = await getChat();
      setSupports(response.data);
    };

    getSupportsList();
  }, []);

  return (
    <>
      {/* <ToolbarWrapper /> */}
      <div className="support">
        <Content>
          <div className="d-flex flex-column flex-lg-row">
            <div className="flex-lg-row-fluid">
              <div
                className="card"
                id="kt_chat_messenger"
                style={{ borderRadius: "0" }}
              >
                <div className="card-header" id="kt_chat_messenger_header">
                  <div className="card-title">
                    <div className="symbol-group symbol-hover"></div>
                    <div className="d-flex justify-content-center flex-column me-3">
                      <a
                        href="#"
                        className="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1"
                      >
                        Informa-Team Support
                      </a>

                      <div className="mb-0 lh-1">
                        <span className="badge badge-success badge-circle w-10px h-10px me-1"></span>
                        <span className="fs-7 fw-bold text-gray-500">
                          Active
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <ChatInner />
              </div>
            </div>
          </div>
        </Content>
      </div>
    </>
  );
}
