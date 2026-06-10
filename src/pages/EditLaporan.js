import { useEffect, useState } from "react";
import { useNavigate, useParams } from "react-router-dom";
import api from "../api/api";

export default function EditLaporan() {

  const { id } = useParams();

  const navigate = useNavigate();

  const [foto, setFoto] = useState(null);

  const [form, setForm] = useState({
    lokasi_fasilitas: "",
    waktu_laporan: "",
    jumlah_fasilitas_rusak: "",
    deskripsi: ""
  });

  useEffect(() => {
    getDetail();
  }, []);

  const getDetail = async () => {

    try {

      const response =
      await api.get(
        `laporan/detail/${id}`
      );

      setForm(response.data);

    } catch(error) {

      console.log(error);

    }

  };

  const handleChange = (e) => {

    setForm({
      ...form,
      [e.target.name]: e.target.value
    });

  };

  const handleSubmit = async (e) => {

    e.preventDefault();

    try {

      const formData = new FormData();

      formData.append(
        "lokasi_fasilitas",
        form.lokasi_fasilitas
      );

      formData.append(
        "waktu_laporan",
        form.waktu_laporan
      );

      formData.append(
        "jumlah_fasilitas_rusak",
        form.jumlah_fasilitas_rusak
      );

      formData.append(
        "deskripsi",
        form.deskripsi
      );

        formData.append(
        "foto_bukti",
        foto
        );

      await api.post(
        `laporan/update/${id}`,
        formData
      );

      alert(
        "Data berhasil diupdate"
      );

      navigate("/laporan");

    } catch(error) {

      console.log(error);

    }

  };

  return (

    <div className="container">

      <div className="card shadow">

        <div className="card-body">

          <h3>Edit Laporan</h3>

          <form onSubmit={handleSubmit}>

            <div className="mb-3">

              <label>Lokasi</label>

              <input
                type="text"
                name="lokasi_fasilitas"
                className="form-control"
                value={form.lokasi_fasilitas}
                onChange={handleChange}
              />

            </div>

            <div className="mb-3">

              <label>Waktu</label>

              <input
                type="datetime-local"
                name="waktu_laporan"
                className="form-control"
                value={form.waktu_laporan}
                onChange={handleChange}
              />

            </div>

            <div className="mb-3">

              <label>Jumlah Rusak</label>

              <input
                type="number"
                name="jumlah_fasilitas_rusak"
                className="form-control"
                value={form.jumlah_fasilitas_rusak}
                onChange={handleChange}
              />

            </div>

            <div className="mb-3">

              <label>Deskripsi</label>

              <textarea
                name="deskripsi"
                className="form-control"
                value={form.deskripsi}
                onChange={handleChange}
              />

            </div>

            <div className="mb-3">

            <label>Foto Baru</label>

            <input
                type="file"
                className="form-control"
                onChange={(e) =>
                setFoto(
                    e.target.files[0]
                )
                }
            />

            </div>

            <button
              className="btn btn-primary"
            >
              Update
            </button>

          </form>

        </div>

      </div>

    </div>

  );

}