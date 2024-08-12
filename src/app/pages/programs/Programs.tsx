import { Content } from "../../../_metronic/layout/components/content";

import Container from "react-bootstrap/Container";
import { useState, useEffect } from "react";
import { getPrograms } from "./core/_requests";

export function Programs() {
  interface Program {
    name: string;
    released_at: string;
    category_name: string;
    telegram_link: string;
    youtube_link: string;
  }

  const [programs, setPrograms] = useState<Program[]>([]);
  const [selectedCategory, setSelectedCategory] = useState<string>("All");

  useEffect(() => {
    const getProgramsList = async () => {
      const response = await getPrograms();
      setPrograms(response.data);
      console.log(response);
    };

    getProgramsList();
  }, []);

  return (
    <Content>
      <div className="d-flex flex-wrap flex-stack mb-6">
        <h3 className="fw-bolder my-2">Programs</h3>
      </div>
      <div className="p-5">
        <div className="mb-4">
          <label htmlFor="category-filter" className="form-label">
            Filter By Category
          </label>
          <select
            id="category-filter"
            className="form-select"
            value={selectedCategory}
            onChange={(e) => setSelectedCategory(e.target.value)}
          >
            <option value="All">All</option>
            {Array.from(
              new Set(
                programs
                  .filter((program) => program.category_name) // Filter out programs with no category_name
                  .map((program) => program.category_name)
              )
            ).map((category) => (
              <option key={category} value={category}>
                {category}
              </option>
            ))}
          </select>
        </div>
        <table className="table table-row-dashed table-row-gray-300 gy-7">
          <thead>
            <tr className="fw-bolder fs-6 text-gray-800">
              <th>Name</th>
              <th>Released At</th>
              <th>Category</th>
              <th>Download Link</th>
              <th>Install Tutorial</th>
            </tr>
          </thead>
          <tbody>
            {programs
              .filter(
                (program) =>
                  selectedCategory === "All" ||
                  program.category_name === selectedCategory
              )
              .map((program: Program, index: number) => (
                <tr key={index}>
                  <td>{program.name}</td>
                  <td>{program.released_at}</td>
                  <td>{program.category_name}</td>
                  <td>{program.telegram_link}</td>
                  <td>{program.youtube_link}</td>
                </tr>
              ))}
          </tbody>
        </table>
      </div>
    </Content>
  );
}
