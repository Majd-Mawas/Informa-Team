import { Content } from "../../../_metronic/layout/components/content";
import Container from "react-bootstrap/Container";
import { useState, useEffect } from "react";
import {
  getCourses,
  GetCategories,
  AddCourse,
  UpdateCourse,
  DeleteCourse,
} from "./core/_requests";
import { Modal, Button, Form } from "react-bootstrap";

export function CoursesAdmin() {
  interface Course {
    name: string;
    by: string;
    released_at: string;
    category_name: string;
    telegram_link: string;
    difficulty: string;
    duration: string;
  }
  interface Category {
    id: number;
    name: string;
  }

  const [courses, setCourses] = useState<Course[]>([]);
  const [Categories, setCategories] = useState<Category[]>([]);
  const [selectedCategory, setSelectedCategory] = useState<string>("All");
  const [showModal, setShowModal] = useState<boolean>(false);
  const [currentCourse, setCurrentCourse] = useState({
    name: "",
    by: "",
    released_at: "",
    categories_id: "",
    telegram_link: "",
    difficulty: "",
    duration: "",
  });
  const [isEditing, setIsEditing] = useState<boolean>(false);

  const getCoursesList = async () => {
    const response = await getCourses();
    setCourses(response.data);
  };
  const getCategoriesList = async () => {
    const response = await GetCategories();
    setCategories(response.data);
  };
  useEffect(() => {
    getCoursesList();
    getCategoriesList();
  }, []);

  const handleShowModal = (course: Course | null) => {
    if (course) {
      setCurrentCourse(course);
    } else {
      setCurrentCourse({
        name: "",
        by: "",
        released_at: "",
        categories_id: "",
        telegram_link: "",
        difficulty: "",
        duration: "",
      });
    }
    setIsEditing(!!course);
    setShowModal(true);
  };

  const handleHideModal = () => {
    setCurrentCourse({
      name: "",
      by: "",
      released_at: "",
      categories_id: "",
      telegram_link: "",
      difficulty: "",
      duration: "",
    });
    setShowModal(false);
    setIsEditing(false);
  };

  const handleDeleteCourse = async (course: Course) => {
    const response = await DeleteCourse(course.id);

    getCoursesList();
  };

  const handleSaveCourse = async () => {
    if (isEditing) {
      const response = await UpdateCourse(currentCourse, currentCourse.id);
    } else {
      const response = await AddCourse(currentCourse);
    }
    handleHideModal();
    getCoursesList();
  };

  return (
    <Content>
      <div className="d-flex flex-wrap flex-stack mb-6 mt-8">
        <h3 className="fw-bolder my-2">Courses</h3>
        <Button size="sm" onClick={() => handleShowModal(null)}>
          Add Course
        </Button>
      </div>
      <div className="p-5">
        <table className="table table-row-dashed table-row-gray-300 gy-7">
          <thead>
            <tr className="fw-bolder fs-6 text-gray-800">
              <th>Name</th>
              <th>Released At</th>
              <th>Level</th>
              <th>Duration</th>
              <th>Category</th>
              <th>Link</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {courses.map((course: Course, index: number) => (
              <tr key={index}>
                <td>{course.name}</td>
                <td>{course.released_at}</td>
                <td>{course.difficulty}</td>
                <td>{course.duration}</td>
                <td>{course.category_name}</td>
                <td>{course.telegram_link}</td>
                <td>
                  <Button
                    size="sm"
                    variant="warning"
                    onClick={() => handleShowModal(course)}
                  >
                    Edit
                  </Button>{" "}
                  <Button
                    size="sm"
                    variant="danger"
                    onClick={() => handleDeleteCourse(course)}
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
          <Modal.Title>{isEditing ? "Edit Course" : "Add Course"}</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <Form>
            <Form.Group className="mb-3">
              <Form.Label>Name</Form.Label>
              <Form.Control
                type="text"
                value={currentCourse?.name || ""}
                onChange={(e) =>
                  setCurrentCourse({ ...currentCourse, name: e.target.value })
                }
              />
            </Form.Group>
            <Form.Group className="mb-3">
              <Form.Label>By</Form.Label>
              <Form.Control
                type="text"
                value={currentCourse?.by || ""}
                onChange={(e) =>
                  setCurrentCourse({ ...currentCourse, by: e.target.value })
                }
              />
            </Form.Group>
            <Form.Group className="mb-3">
              <Form.Label>Released At</Form.Label>
              <Form.Control
                type="date"
                value={currentCourse?.released_at || ""}
                onChange={(e) =>
                  setCurrentCourse({
                    ...currentCourse,
                    released_at: e.target.value,
                  })
                }
              />
            </Form.Group>

            <Form.Group className="mb-3">
              <Form.Label>
                Duration <span className="text-mute">In Hours</span>
              </Form.Label>
              <Form.Control
                type="text"
                value={currentCourse?.duration || ""}
                onChange={(e) =>
                  setCurrentCourse({
                    ...currentCourse,
                    duration: e.target.value,
                  })
                }
              />
            </Form.Group>

            <Form.Group className="mb-3">
              <Form.Label>Level</Form.Label>
              <Form.Select
                aria-label="Default select example"
                value={currentCourse?.difficulty || ""}
                onChange={(e) =>
                  setCurrentCourse({
                    ...currentCourse,
                    difficulty: e.target.value,
                  })
                }
              >
                <option hidden>Open this select menu</option>
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Advanced">Advanced</option>
              </Form.Select>
            </Form.Group>

            <Form.Group className="mb-3">
              <Form.Label>Category</Form.Label>
              <Form.Select
                aria-label="Default select example"
                value={currentCourse?.categories_id || ""}
                onChange={(e) =>
                  setCurrentCourse({
                    ...currentCourse,
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
            </Form.Group>
            <Form.Group className="mb-3">
              <Form.Label>Course Link</Form.Label>
              <Form.Control
                type="text"
                value={currentCourse?.telegram_link || ""}
                onChange={(e) =>
                  setCurrentCourse({
                    ...currentCourse,
                    telegram_link: e.target.value,
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
          <Button variant="primary" onClick={handleSaveCourse}>
            {isEditing ? "Save Changes" : "Add Course"}
          </Button>
        </Modal.Footer>
      </Modal>
    </Content>
  );
}
