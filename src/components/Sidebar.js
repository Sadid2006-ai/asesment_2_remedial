import { Link, useLocation, useNavigate } from "react-router-dom";

export default function Sidebar() {
  const location = useLocation();
  const navigate = useNavigate();

  const menus = [
    { path: "/", label: "Dashboard", icon: "📊" },
    { path: "/laporan", label: "Data Laporan", icon: "📋" },
    { path: "/tambah-laporan", label: "Tambah Laporan", icon: "➕" },
  ];

  const handleLogout = () => {
    const konfirmasi = window.confirm("Yakin ingin logout?");
    if (!konfirmasi) return;
    localStorage.removeItem("user");
    navigate("/login");
  };

  return (
    <div
      className="bg-dark text-white p-3 d-flex flex-column"
      style={{ minHeight: "100vh", width: "220px", flexShrink: 0 }}
    >
      <div>
        <h5 className="fw-bold mb-1">SmartCampus</h5>
        <small className="text-secondary">Facility Management</small>
        <hr />

        <ul className="nav flex-column gap-1">
          {menus.map((menu) => (
            <li className="nav-item" key={menu.path}>
              <Link
                className={`nav-link d-flex align-items-center gap-2 rounded px-2 py-2 ${
                  location.pathname === menu.path
                    ? "bg-primary text-white"
                    : "text-white-50"
                }`}
                to={menu.path}
              >
                <span>{menu.icon}</span>
                <span>{menu.label}</span>
              </Link>
            </li>
          ))}
        </ul>
      </div>

      {/* Tombol Logout di bagian bawah sidebar */}
      <div className="mt-auto">
        <hr />
        <button
          className="btn btn-outline-danger w-100"
          onClick={handleLogout}
        >
          🚪 Logout
        </button>
      </div>
    </div>
  );
}
