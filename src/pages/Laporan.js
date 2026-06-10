import { useEffect, useState } from "react";
import api from "../api/api";
import { Link } from "react-router-dom";

export default function Laporan() {

  const [laporan, setLaporan] = useState([]);

  useEffect(() => {
    getData();
  }, []);

  const getData = async () => {

    try {

      const response =
      await api.get("laporan");

      setLaporan(response.data);

    } catch(error) {

      console.log(error);

    }

  };

  // FUNGSI HAPUS HARUS ADA DI SINI
  const hapusData = async (id) => {

    const konfirmasi =
    window.confirm(
      "Yakin ingin menghapus data?"
    );

    if(!konfirmasi) return;

    try {

      await api.delete(
        `laporan/delete/${id}`
      );

      alert(
        "Data berhasil dihapus"
      );

      getData();

    } catch(error) {

      console.log(error);

    }

  };

  return (

    <div className="container mt-4">

      <h2>Data Laporan</h2>

      <table className="table table-bordered">

        <thead>

          <tr>
            <th>ID</th>
            <th>Lokasi</th>
            <th>Status</th>
            <th>Jumlah</th>
            <th>deskripsi</th>
            <th>Foto</th>
            <th>Aksi</th>
          </tr>

        </thead>

        <tbody>

          {
            laporan.map((item) => (

              <tr key={item.id}>

                <td>{item.id}</td>

                <td>{item.lokasi_fasilitas}</td>

                <td>

                  {
                  item.status_kerusakan === "Ringan" ?

                  <span className="badge bg-success">
                  Ringan
                  </span>

                  :

                  item.status_kerusakan === "Sedang" ?

                  <span className="badge bg-warning">
                  Sedang
                  </span>

                  :

                  <span className="badge bg-danger">
                  Berat
                  </span>
                  }

                  </td>

                <td>{item.jumlah_fasilitas_rusak}</td>

                <td>{item.deskripsi}</td>

                <td>

                  {
                    item.foto_bukti ?

                    <img
                      src={
                        `http://localhost/smartcampus_facility/ci3_project/uploads/${item.foto_bukti}`
                      }
                      alt=""
                      width="80"
                    />

                    :

                    "Tidak Ada"
                  }

                </td>

                <td>

                  <td>

                    <Link
                      to={`/edit-laporan/${item.id}`}
                      className="btn btn-warning btn-sm me-2"
                    >
                      Edit
                    </Link>

                    <button
                      className="btn btn-danger btn-sm"
                      onClick={() =>
                        hapusData(item.id)
                      }
                    >
                      Hapus
                    </button>

                  </td>

                </td>

              </tr>

            ))
          }

        </tbody>

      </table>

    </div>

  );

}