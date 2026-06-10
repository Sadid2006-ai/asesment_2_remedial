import {
  Chart as ChartJS,
  ArcElement,
  Tooltip,
  Legend
} from "chart.js";

import { Doughnut } from "react-chartjs-2";

ChartJS.register(
  ArcElement,
  Tooltip,
  Legend
);

export default function LaporanChart({
  ringan,
  sedang,
  berat
}) {

  const data = {

    labels: [
      "Ringan",
      "Sedang",
      "Berat"
    ],

    datasets: [

      {
        data: [
          ringan,
          sedang,
          berat
        ]
      }

    ]

  };

  return (

    <div className="card shadow">

      <div className="card-body">

        <h5>Grafik Kerusakan</h5>

        <Doughnut data={data} />

      </div>

    </div>

  );

}