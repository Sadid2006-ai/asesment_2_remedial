import { useEffect, useState } from "react";
import api from "../api/api";
import StatCard from "../components/StatCard";
import LaporanChart
from "../components/LaporanChart";

export default function Dashboard() {

  const [laporan,setLaporan] =
  useState([]);

  useEffect(() => {

    getData();

  }, []);

  const getData = async () => {

    try {

      const res =
      await api.get("laporan");

      setLaporan(res.data);

    } catch(err) {

      console.log(err);

    }

  };

  const total =
  laporan.length;

  const ringan =
  laporan.filter(
    x =>
    x.status_kerusakan ===
    "Ringan"
  ).length;

  const sedang =
  laporan.filter(
    x =>
    x.status_kerusakan ===
    "Sedang"
  ).length;

  const berat =
  laporan.filter(
    x =>
    x.status_kerusakan ===
    "Berat"
  ).length;

  return (

    <div className="container-fluid">

      <h2 className="mb-4">

        Dashboard

      </h2>

      <div className="row">

        <div className="col-md-3 mb-3">

          <StatCard
            title="Total Laporan"
            value={total}
          />

        </div>

        <div className="col-md-3 mb-3">

          <StatCard
            title="Ringan"
            value={ringan}
          />

        </div>

        <div className="col-md-3 mb-3">

          <StatCard
            title="Sedang"
            value={sedang}
          />

        </div>

        <div className="col-md-3 mb-3">

          <StatCard
            title="Berat"
            value={berat}
          />

        </div>

        <div className="row mt-4">

          <div className="col-md-6">

            <LaporanChart
              ringan={ringan}
              sedang={sedang}
              berat={berat}
            />

          </div>

        </div>

      </div>

    </div>

  );

}