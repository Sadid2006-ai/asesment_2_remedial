import { useState } from "react";
import { useNavigate, Link } from "react-router-dom";
import api from "../api/api";

export default function Login() {
  const navigate = useNavigate();
  const [form, setForm] = useState({ email: "", password: "" });
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");
    setLoading(true);

    try {
      const formData = new FormData();
      formData.append("email", form.email);
      formData.append("password", form.password);

      const res = await api.post("auth/login", formData);

      if (res.data.status) {
        localStorage.setItem("user", JSON.stringify(res.data.user));
        navigate("/");
      } else {
        setError(res.data.message || "Email atau password salah");
      }
    } catch (err) {
      setError("Gagal terhubung ke server");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div
      className="d-flex justify-content-center align-items-center bg-light"
      style={{ minHeight: "100vh" }}
    >
      <div className="card shadow" style={{ width: "400px" }}>
        <div className="card-body p-4">
          <h3 className="text-center mb-1 text-primary fw-bold">
            SmartCampus
          </h3>
          <p className="text-center text-muted mb-4">
            Facility Management System
          </p>

          {error && (
            <div className="alert alert-danger py-2">{error}</div>
          )}

          <form onSubmit={handleSubmit}>
            <div className="mb-3">
              <label className="form-label fw-semibold">Email</label>
              <input
                type="email"
                className="form-control"
                name="email"
                placeholder="email@example.com"
                value={form.email}
                onChange={handleChange}
                required
              />
            </div>

            <div className="mb-3">
              <label className="form-label fw-semibold">Password</label>
              <input
                type="password"
                className="form-control"
                name="password"
                placeholder="••••••••"
                value={form.password}
                onChange={handleChange}
                required
              />
            </div>

            <button
              type="submit"
              className="btn btn-primary w-100 mt-2"
              disabled={loading}
            >
              {loading ? "Memproses..." : "Login"}
            </button>
          </form>

          <p className="text-center mt-3 mb-0">
            Belum punya akun?{" "}
            <Link to="/register" className="text-primary fw-semibold">
              Daftar di sini
            </Link>
          </p>
        </div>
      </div>
    </div>
  );
}
