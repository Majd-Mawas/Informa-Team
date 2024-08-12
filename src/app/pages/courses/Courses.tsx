import { Content } from "../../../_metronic/layout/components/content";
import Container from "react-bootstrap/Container";
import Card from "react-bootstrap/Card";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Form from "react-bootstrap/Form";
import { useState, useEffect } from "react";
import { getCourses } from "./core/_requests";

export function Courses() {
  interface Course {
    name: string;
    by: string;
    released_at: string;
    category_name: string;
    telegram_link: string;
    difficulty: string;
    duration: string;
  }

  const [courses, setCourses] = useState<Course[]>([]);
  const [selectedCategory, setSelectedCategory] = useState<string>("All");
  const [selectedDifficulty, setSelectedDifficulty] = useState<string>("All");
  const [searchTerm, setSearchTerm] = useState<string>("");

  useEffect(() => {
    const getCoursesList = async () => {
      const response = await getCourses();
      setCourses(response.data);
      console.log(response);
    };

    getCoursesList();
  }, []);

  const filteredCourses = courses.filter(
    (course) =>
      (selectedCategory === "All" ||
        course.category_name === selectedCategory) &&
      (selectedDifficulty === "All" ||
        course.difficulty === selectedDifficulty) &&
      (course.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
        course.by.toLowerCase().includes(searchTerm.toLowerCase()))
  );

  return (
    <Content>
      <div className="d-flex flex-wrap flex-stack mb-6">
        <h3 className="fw-bolder my-2">Courses</h3>
      </div>
      <div className="p-5">
        <Row className="mb-4">
          <Col xs={12} md={4}>
            <Form.Group controlId="category-filter">
              <Form.Label>Filter by Level</Form.Label>
              <Form.Control
                as="select"
                value={selectedCategory}
                onChange={(e) => setSelectedCategory(e.target.value)}
              >
                <option value="All">All</option>
                {Array.from(
                  new Set(
                    courses
                      .filter((course) => course.category_name)
                      .map((course) => course.category_name)
                  )
                ).map((category) => (
                  <option key={category} value={category}>
                    {category}
                  </option>
                ))}
              </Form.Control>
            </Form.Group>
          </Col>
          <Col xs={12} md={4}>
            <Form.Group controlId="difficulty-filter">
              <Form.Label>Filter by Difficulty</Form.Label>
              <Form.Control
                as="select"
                value={selectedDifficulty}
                onChange={(e) => setSelectedDifficulty(e.target.value)}
              >
                <option value="All">All</option>
                {Array.from(
                  new Set(
                    courses
                      .filter((course) => course.difficulty)
                      .map((course) => course.difficulty)
                  )
                ).map((difficulty) => (
                  <option key={difficulty} value={difficulty}>
                    {difficulty}
                  </option>
                ))}
              </Form.Control>
            </Form.Group>
          </Col>
          <Col xs={12} md={4}>
            <Form.Group controlId="search-term">
              <Form.Label>Search</Form.Label>
              <Form.Control
                type="text"
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                placeholder="Search by name or author"
              />
            </Form.Group>
          </Col>
        </Row>
        <Row xs={1} md={2} lg={3} className="g-4">
          {filteredCourses.map((course: Course, index: number) => (
            <Col key={index}>
              <Card className="h-100">
                <Card.Body>
                  <Card.Title>{course.name}</Card.Title>
                  <Card.Subtitle className="mb-2 text-muted">
                    {course.by}
                  </Card.Subtitle>
                  <Card.Text>
                    <strong>Released At:</strong> {course.released_at}
                    <br />
                    <strong>Level:</strong> {course.difficulty}
                    <br />
                    <strong>Duration:</strong> {course.duration}
                    <br />
                    <strong>Category:</strong> {course.category_name}
                  </Card.Text>
                  <Card.Link href={course.telegram_link} target="_blank">
                    Course Link
                  </Card.Link>
                </Card.Body>
              </Card>
            </Col>
          ))}
        </Row>
      </div>
    </Content>
  );
}
