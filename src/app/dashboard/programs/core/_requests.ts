import axios, { AxiosResponse } from "axios";
import { ID, Response } from "../../../../_metronic/helpers";
import { date } from "yup";

const API_URL = import.meta.env.VITE_APP_API_URL;
const PROGRAM_URL = `${API_URL}/programs`;
const CATEGORIES_URL = `${API_URL}/categories`;

const getPrograms = async () => {
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

const AddPrograms = async (currentProgram:any) => {
  return axios
    .post(PROGRAM_URL,currentProgram)
    .then((response: AxiosResponse) => {
      return response.data; // Ensure you are returning the data from the response
    })
    .catch((error) => {
      console.error("Error fetching programs", error);
      throw error; // Re-throw the error to handle it in the calling function
    });
};

const UpdateProgram = async (currentProgram:any,id:number) => {
  return axios
    .put(PROGRAM_URL +"/"+id,currentProgram)
    .then((response: AxiosResponse) => {
      return response.data; // Ensure you are returning the data from the response
    })
    .catch((error) => {
      console.error("Error fetching programs", error);
      throw error; // Re-throw the error to handle it in the calling function
    });
};

const DeleteProgram = async (id:number) => {
  return axios
    .delete(PROGRAM_URL +"/"+id)
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
  getPrograms,
  GetCategories,
  AddPrograms,
  UpdateProgram,
  DeleteProgram
};