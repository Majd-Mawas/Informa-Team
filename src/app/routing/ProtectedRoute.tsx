import React, { ReactElement } from "react";
import { Navigate } from "react-router-dom";
// import {AuthModel, UserModel} from './models'
import { UserModel } from "../modules/auth/core/_models";


interface ProtectedRouteProps {
  element: ReactElement;
  allowedRoles: number[];
  currentUser?: UserModel;
}

const ProtectedRoute: React.FC<ProtectedRouteProps> = ({
  element,
  allowedRoles,
  currentUser,
}) => {
  if (!currentUser || !allowedRoles.includes(currentUser.role_id)) {
    // Redirect if the user is not logged in or does not have the required permissions
    return <Navigate to="/forbidden" />;
  }

  return element;
};

export default ProtectedRoute;
