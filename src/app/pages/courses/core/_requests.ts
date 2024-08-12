import axios, { AxiosResponse } from "axios";
import { ID, Response } from "../../../../_metronic/helpers";
import { date } from "yup";

const API_URL = import.meta.env.VITE_APP_API_URL;
const PROGRAM_URL = `${API_URL}/courses`;
const GET_USERS_URL = `${API_URL}/users/query`;

const getCourses = async () => {
  return axios
    .get(PROGRAM_URL)
    .then((response: AxiosResponse) => {
      return response.data; // Ensure you are returning the data from the response
    })
    .catch((error) => {
      console.error("Error fetching programs", error);
      throw error; // Re-throw the error to handle it in the calling function
    });
};


export {
  getCourses
};
