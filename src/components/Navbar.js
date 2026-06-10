import { useNavigate } from "react-router-dom";

export default function Navbar() {
  const navigate = useNavigate();
  const user = JSON.parse(localStorage.getItem("user") || "{}");

  const handleLogout = () => {
    const konfirmasi = window.confirm("Yakin ingin logout?");
    if (!konfirmasi) return;
    localStorage.removeItem("user");
    navigate("/login");
  };

  return (
    <nav className="navbar navbar-dark bg-primary px-3">
      <span className="navbar-brand fw-bold">SmartCampus Facility</span>
      <div className="d-flex align-items-center gap-3">
        <span className="text-white">
          👤 {user.nama || "User"}
        </span>
        <button
          className="btn btn-outline-light btn-sm"
          onClick={handleLogout}
        >
          Logout
        </button>
      </div>
    </nav>
  );
}
