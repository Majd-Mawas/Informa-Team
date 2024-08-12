import { lazy, FC, Suspense, useEffect } from "react";
import { Route, Routes, Navigate } from "react-router-dom";
import { MasterLayout } from "../../_metronic/layout/MasterLayout";
import { DashboardLayout } from "../../_metronic/layout/DashboardLayout";
import TopBarProgress from "react-topbar-progress-indicator";

import { Roadmap } from "../pages/roadmaps/Roadmap";
import { Programs } from "../pages/programs/Programs";
import { Courses } from "../pages/courses/Courses";
import { Support } from "../pages/support/support";

import { DashboardWrapper } from "../dashboard/DashboardWrapper";
import { Users } from "../dashboard/users/Users";
import { ProgramsAdmin } from "../dashboard/programs/Programs";
import { CoursesAdmin } from "../dashboard/courses/Courses";
import { SupportAdmin } from "../dashboard/support/support";

import { getCSSVariableValue } from "../../_metronic/assets/ts/_utils";
import { WithChildren } from "../../_metronic/helpers";
import { useAuth } from "../modules/auth";
import ProtectedRoute from "./ProtectedRoute";

const PrivateRoutes = () => {
  const { currentUser } = useAuth();

  const ProfilePage = lazy(() => import("../modules/profile/ProfilePage"));
  const WizardsPage = lazy(() => import("../modules/wizards/WizardsPage"));
  const AccountPage = lazy(() => import("../modules/accounts/AccountPage"));
  const WidgetsPage = lazy(() => import("../modules/widgets/WidgetsPage"));
  const ChatPage = lazy(() => import("../modules/apps/chat/ChatPage"));
  const UsersPage = lazy(
    () => import("../modules/apps/user-management/UsersPage")
  );

  return (
    <Routes>
      {currentUser && currentUser.role_id == 3 ? (
        <>
          <Route element={<MasterLayout />}>
            <Route path="auth/*" element={<Navigate to="/roadmap" />} />
            <Route
              path="roadmap"
              element={
                <ProtectedRoute
                  element={<Roadmap />}
                  allowedRoles={[3]}
                  currentUser={currentUser}
                />
              }
            />
            <Route
              path="programs"
              element={
                <ProtectedRoute
                  element={<Programs />}
                  allowedRoles={[3]}
                  currentUser={currentUser}
                />
              }
            />
            <Route
              path="courses"
              element={
                <ProtectedRoute
                  element={<Courses />}
                  allowedRoles={[3]}
                  currentUser={currentUser}
                />
              }
            />
            <Route
              path="support"
              element={
                <ProtectedRoute
                  element={<Support />}
                  allowedRoles={[3]}
                  currentUser={currentUser}
                />
              }
            />
          </Route>
        </>
      ) : (
        <>
          <Route element={<DashboardLayout />}>
            <Route path="auth/*" element={<Navigate to="/admin/dashboard" />} />
            <Route
              path="admin/dashboard"
              element={
                <ProtectedRoute
                  element={<DashboardWrapper />}
                  allowedRoles={[1]}
                  currentUser={currentUser}
                />
              }
            />
            <Route
              path="admin/users"
              element={
                <ProtectedRoute
                  element={<Users />}
                  allowedRoles={[1]}
                  currentUser={currentUser}
                />
              }
            />
            <Route
              path="admin/programs"
              element={
                <ProtectedRoute
                  element={<ProgramsAdmin />}
                  allowedRoles={[1]}
                  currentUser={currentUser}
                />
              }
            />
            <Route
              path="admin/courses"
              element={
                <ProtectedRoute
                  element={<CoursesAdmin />}
                  allowedRoles={[1]}
                  currentUser={currentUser}
                />
              }
            />
            <Route
              path="admin/support"
              element={
                <ProtectedRoute
                  element={<SupportAdmin />}
                  allowedRoles={[1]}
                  currentUser={currentUser}
                />
              }
            />
          </Route>
        </>
      )}

      {/* Lazy Modules */}
      <Route
        path="crafted/pages/profile/*"
        element={
          <SuspensedView>
            <ProfilePage />
          </SuspensedView>
        }
      />
      <Route
        path="crafted/pages/wizards/*"
        element={
          <SuspensedView>
            <WizardsPage />
          </SuspensedView>
        }
      />
      <Route
        path="crafted/widgets/*"
        element={
          <SuspensedView>
            <WidgetsPage />
          </SuspensedView>
        }
      />
      <Route
        path="crafted/account/*"
        element={
          <SuspensedView>
            <AccountPage />
          </SuspensedView>
        }
      />
      <Route
        path="apps/chat/*"
        element={
          <SuspensedView>
            <ChatPage />
          </SuspensedView>
        }
      />
      <Route
        path="apps/user-management/*"
        element={
          <SuspensedView>
            <UsersPage />
          </SuspensedView>
        }
      />
      {/* Page Not Found */}
      {/* <Route path="*" element={<Navigate to="/error/404" />} /> */}
    </Routes>
  );
};

const SuspensedView: FC<WithChildren> = ({ children }) => {
  const baseColor = getCSSVariableValue("--bs-primary");
  TopBarProgress.config({
    barColors: {
      "0": baseColor,
    },
    barThickness: 1,
    shadowBlur: 5,
  });
  return <Suspense fallback={<TopBarProgress />}>{children}</Suspense>;
};

export { PrivateRoutes };
