import { useIntl } from "react-intl";
import { MenuItem } from "./MenuItem";
import { MenuInnerWithSub } from "./MenuInnerWithSub";
import { MegaMenu } from "./MegaMenu";
import { useAuth } from "../../../../../app/modules/auth";

export function MenuInner() {
  const intl = useIntl();
  const { currentUser, logout } = useAuth();

  return (
    <>
      {/* <MenuItem
        title={intl.formatMessage({ id: "MENU.DASHBOARD" })}
        to="/dashboard"
      /> */}

      {currentUser && currentUser.role_id == 3 ? (
        <>
          <MenuItem title="Roadmaps" to="/roadmap" />
          <MenuItem title="Programs" to="/programs" />
          <MenuItem title="Courses" to="/courses" />
          <MenuItem title="Support" to="/support" />
        </>
      ) : (
        <>
          <MenuItem title="Dashboard" to="/admin/dashboard" />
          <MenuItem title="Users" to="/admin/users" />
          <MenuItem title="Courses" to="/admin/courses" />
          <MenuItem title="Programs" to="/admin/Programs" />
          <MenuItem title="Support" to="/admin/support" />
        </>
      )}
    </>
  );
}
