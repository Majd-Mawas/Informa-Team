import { Content } from "../../../_metronic/layout/components/content";

import Container from "react-bootstrap/Container";
import { useState, useEffect } from "react";
import { getUsers } from "./core/_requests";

export function Users() {
  interface User {
    name: string;
    email: string;
    phone: string;
    education: string;
  }

  const [users, setUsers] = useState<User[]>([]);

  useEffect(() => {
    const getUsersList = async () => {
      const response = await getUsers();
      setUsers(response.data);
    };

    getUsersList();
  }, []);

  return (
    <Content>
      <div className="d-flex flex-wrap flex-stack mb-6">
        <h3 className="fw-bolder my-2">Users List</h3>
      </div>
      <div className="p-5">
        <table className="table table-row-dashed table-row-gray-300 gy-7">
          <thead>
            <tr className="fw-bolder fs-6 text-gray-800">
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Education</th>
            </tr>
          </thead>
          <tbody>
            {users.map((user: User, index: number) => (
              <tr key={index}>
                <td>{user.name}</td>
                <td>{user.email}</td>
                <td>{user.phone}</td>
                <td>{user.education}</td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </Content>
  );
}
