import { useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../api/api";

export default function TambahLaporan() {

  const navigate = useNavigate();

  const [foto, setFoto] = useState(null);

  const [form, setForm] = useState({

    user_id: 1,

    lokasi_fasilitas: "",

    waktu_laporan: "",

    jumlah_fasilitas_rusak: "",

    deskripsi: ""

  });

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
        "user_id",
        form.user_id
      );

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
        "laporan/create",
        formData
      );

      alert(
        "Laporan berhasil ditambahkan"
      );

      navigate("/laporan");

    } catch(error) {

      console.log(error);

      alert(
        "Gagal menambah laporan"
      );

    }

  };

  

  return (

    <div className="container">

      <div className="card shadow">

        <div className="card-body">

          <h3>
            Tambah Laporan
          </h3>

          <form
            onSubmit={handleSubmit}
          >

            <div className="mb-3">

              <label>
                Lokasi Fasilitas
              </label>

              <input
                type="text"
                className="form-control"
                name="lokasi_fasilitas"
                onChange={handleChange}
              />

            </div>

            <div className="mb-3">

              <label>
                Waktu Laporan
              </label>

              <input
                type="datetime-local"
                className="form-control"
                name="waktu_laporan"
                onChange={handleChange}
              />

            </div>

            <div className="mb-3">

              <label>
                Jumlah Fasilitas Rusak
              </label>

              <input
                type="number"
                className="form-control"
                name="jumlah_fasilitas_rusak"
                onChange={handleChange}
              />

            </div>

            <div className="mb-3">

              <label>
                Deskripsi
              </label>

              <textarea
                className="form-control"
                name="deskripsi"
                onChange={handleChange}
              />

            </div>

            <div className="mb-3">

            <label>Foto Bukti</label>

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
              Simpan
            </button>

          </form>

        </div>

      </div>

    </div>

  );

}