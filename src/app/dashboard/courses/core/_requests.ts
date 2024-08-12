import axios, { AxiosResponse } from "axios";
import { ID, Response } from "../../../../_metronic/helpers";
import { date } from "yup";

const API_URL = import.meta.env.VITE_APP_API_URL;
const COURSE_URL = `${API_URL}/courses`;
const CATEGORIES_URL = `${API_URL}/categories`;

const getCourses = async () => {
  return axios
    .get(COURSE_URL)
    .then((response: AxiosResponse) => {
      return response.data; // Ensure you are returning the data from the response
    })
    .catch((error) => {
      console.error("Error fetching programs", error);
      throw error; // Re-throw the error to handle it in the calling function
    });
};

const AddCourse = async (currentProgram:any) => {
  return axios
    .post(COURSE_URL,currentProgram)
    .then((response: AxiosResponse) => {
      return response.data; // Ensure you are returning the data from the response
    })
    .catch((error) => {
      console.error("Error fetching programs", error);
      throw error; // Re-throw the error to handle it in the calling function
    });
};

const UpdateCourse = async (currentProgram:any,id:number) => {
  return axios
    .put(COURSE_URL +"/"+id,currentProgram)
    .then((response: AxiosResponse) => {
      return response.data; // Ensure you are returning the data from the response
    })
    .catch((error) => {
      console.error("Error fetching programs", error);
      throw error; // Re-throw the error to handle it in the calling function
    });
};

const DeleteCourse = async (id:number) => {
  return axios
    .delete(COURSE_URL +"/"+id)
    .then((response: AxiosResponse) => {
      return response.data; // Ensure you are returning the data from the response
    })
    .catch((error) => {
      console.error("Error fetching programs", error);
      throw error; // Re-throw the error to handle it in the calling function
    });
};

const GetCategories = async () => {
  return axios
  .get(CATEGORIES_URL)
  .then((response: AxiosResponse) => {
    return response.data; // Ensure you are returning the data from the response
  })
  .catch((error) => {
    console.error("Error fetching programs", error);
    throw error; // Re-throw the error to handle it in the calling function
  });
}

export {
  getCourses,
  GetCategories,
  AddCourse,
  UpdateCourse,
  DeleteCourse
};