import { Content } from "../../../_metronic/layout/components/content";
import Container from "react-bootstrap/Container";
import { useState, useEffect } from "react";
import {
  getPrograms,
  GetCategories,
  AddPrograms,
  UpdateProgram,
  DeleteProgram,
} from "./core/_requests";
import { Modal, Button, Form } from "react-bootstrap";

export function ProgramsAdmin() {
  interface Program {
    name: string;
    released_at: string;
    category_name: string;
    telegram_link: string;
    youtube_link: string;
  }
  interface Category {
    id: number;
    name: string;
  }

  const [programs, setPrograms] = useState<Program[]>([]);
  const [Categories, setCategories] = useState<Category[]>([]);
  const [selectedCategory, setSelectedCategory] = useState<string>("All");
  const [showModal, setShowModal] = useState<boolean>(false);
  const [currentProgram, setCurrentProgram] = useState({
    name: "",
    released_at: "",
    categories_id: "",
    telegram_link: "",
    youtube_link: "",
  });
  const [isEditing, setIsEditing] = useState<boolean>(false);

  const getProgramsList = async () => {
    const response = await getPrograms();
    setPrograms(response.data);
  };
  const getCategoriesList = async () => {
    const response = await GetCategories();
    setCategories(response.data);
  };
  useEffect(() => {
    getProgramsList();
    getCategoriesList();
  }, []);

  const handleShowModal = (program: Program | null) => {
    if (program) {
      setCurrentProgram(program);
    } else {
      setCurrentProgram({
        name: "",
        released_at: "",
        categories_id: "",
        telegram_link: "",
        youtube_link: "",
      });
    }
    setIsEditing(!!program);
    setShowModal(true);
  };

  const handleHideModal = () => {
    setCurrentProgram({
      name: "",
      released_at: "",
      categories_id: "",
      telegram_link: "",
      youtube_link: "",
    });
    setShowModal(false);
    setIsEditing(false);
  };

  const handleDeleteProgram = async (program: Program) => {
    const response = await DeleteProgram(program.id);

    getProgramsList();
  };

  const handleSaveProgram = async () => {
    if (isEditing) {
      const response = await UpdateProgram(currentProgram, currentProgram.id);
    } else {
      const response = await AddPrograms(currentProgram);
    }
    handleHideModal();
    getProgramsList();
  };

  return (
    <Content>
      <div className="d-flex flex-wrap flex-stack mb-6 mt-8">
        <h3 className="fw-bolder my-2">Programs</h3>
        <Button size="sm" onClick={() => handleShowModal(null)}>
          Add Program
        </Button>
      </div>
      <div className="p-5">
        <table className="table table-row-dashed table-row-gray-300 gy-7">
          <thead>
            <tr className="fw-bolder fs-6 text-gray-800">
              <th>Name</th>
              <th>Released At</th>
              <th>Category</th>
              <th>Download Link</th>
              <th>Install Tutorial</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {programs.map((program: Program, index: number) => (
              <tr key={index}>
                <td>{program.name}</td>
                <td>{program.released_at}</td>
                <td>{program.category_name}</td>
                <td>{program.telegram_link}</td>
                <td>{program.youtube_link}</td>
                <td>
                  <Button
                    size="sm"
                    variant="warning"
                    onClick={() => handleShowModal(program)}
                  >
                    Edit
                  </Button>{" "}
                  <Button
                    size="sm"
                    variant="danger"
                    onClick={() => handleDeleteProgram(program)}
                  >
                    Delete
                  </Button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>

      <Modal show={showModal} onHide={handleHideModal}>
        <Modal.Header closeButton>
          <Modal.Title>
            {isEditing ? "Edit Program" : "Add Program"}
          </Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <Form>
            <Form.Group className="mb-3">
              <Form.Label>Name</Form.Label>
              <Form.Control
                type="text"
                value={currentProgram?.name || ""}
                onChange={(e) =>
                  setCurrentProgram({ ...currentProgram, name: e.target.value })
                }
              />
            </Form.Group>
            <Form.Group className="mb-3">
              <Form.Label>Released At</Form.Label>
              <Form.Control
                type="date"
                value={currentProgram?.released_at || ""}
                onChange={(e) =>
                  setCurrentProgram({
                    ...currentProgram,
                    released_at: e.target.value,
                  })
                }
              />
            </Form.Group>
            <Form.Group className="mb-3">
              <Form.Label>Category</Form.Label>
              <Form.Select
                aria-label="Default select example"
                value={currentProgram?.categories_id || ""}
                onChange={(e) =>
                  setCurrentProgram({
                    ...currentProgram,
                    categories_id: e.target.value,
                  })
                }
              >
                <option hidden>Open this select menu</option>
                {Categories.map((category: Category, index) => (
                  <option key={index} value={category.id}>
                    {category.name}
                  </option>
                ))}
              </Form.Select>
              {/* <Form.Control
                type="text"
                value={currentProgram?.category_name || ""}
                onChange={(e) =>
                  setCurrentProgram({
                    ...currentProgram,
                    category_name: e.target.value,
                  })
                }
              /> */}
            </Form.Group>
            <Form.Group className="mb-3">
              <Form.Label>Download Link</Form.Label>
              <Form.Control
                type="text"
                value={currentProgram?.telegram_link || ""}
                onChange={(e) =>
                  setCurrentProgram({
                    ...currentProgram,
                    telegram_link: e.target.value,
                  })
                }
              />
            </Form.Group>
            <Form.Group className="mb-3">
              <Form.Label>Install Tutorial</Form.Label>
              <Form.Control
                type="text"
                value={currentProgram?.youtube_link || ""}
                onChange={(e) =>
                  setCurrentProgram({
                    ...currentProgram,
                    youtube_link: e.target.value,
                  })
                }
              />
            </Form.Group>
          </Form>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={handleHideModal}>
            Close
          </Button>
          <Button variant="primary" onClick={handleSaveProgram}>
            {isEditing ? "Save Changes" : "Add Program"}
          </Button>
        </Modal.Footer>
      </Modal>
    </Content>
  );
}
