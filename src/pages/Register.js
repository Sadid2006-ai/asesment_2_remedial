import { useState } from "react";
import { useNavigate, Link } from "react-router-dom";
import api from "../api/api";

export default function Register() {
  const navigate = useNavigate();
  const [form, setForm] = useState({ nama: "", email: "", password: "", konfirmasi: "" });
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");

    if (form.password !== form.konfirmasi) {
      setError("Password dan konfirmasi password tidak sama");
      return;
    }

    if (form.password.length < 6) {
      setError("Password minimal 6 karakter");
      return;
    }

    setLoading(true);

    try {
      const formData = new FormData();
      formData.append("nama", form.nama);
      formData.append("email", form.email);
      formData.append("password", form.password);

      const res = await api.post("auth/register", formData);

      if (res.data.status) {
        alert("Registrasi berhasil! Silahkan login.");
        navigate("/login");
      } else {
        setError(res.data.message || "Registrasi gagal");
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
      <div className="card shadow" style={{ width: "420px" }}>
        <div className="card-body p-4">
          <h3 className="text-center mb-1 text-primary fw-bold">
            SmartCampus
          </h3>
          <p className="text-center text-muted mb-4">Buat Akun Baru</p>

          {error && (
            <div className="alert alert-danger py-2">{error}</div>
          )}

          <form onSubmit={handleSubmit}>
            <div className="mb-3">
              <label className="form-label fw-semibold">Nama Lengkap</label>
              <input
                type="text"
                className="form-control"
                name="nama"
                placeholder="Nama lengkap"
                value={form.nama}
                onChange={handleChange}
                required
              />
            </div>

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
                placeholder="Minimal 6 karakter"
                value={form.password}
                onChange={handleChange}
                required
              />
            </div>

            <div className="mb-3">
              <label className="form-label fw-semibold">
                Konfirmasi Password
              </label>
              <input
                type="password"
                className="form-control"
                name="konfirmasi"
                placeholder="Ulangi password"
                value={form.konfirmasi}
                onChange={handleChange}
                required
              />
            </div>

            <button
              type="submit"
              className="btn btn-success w-100 mt-2"
              disabled={loading}
            >
              {loading ? "Memproses..." : "Daftar"}
            </button>
          </form>

          <p className="text-center mt-3 mb-0">
            Sudah punya akun?{" "}
            <Link to="/login" className="text-primary fw-semibold">
              Login di sini
            </Link>
          </p>
        </div>
      </div>
    </div>
  );
}
