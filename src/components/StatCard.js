export default function StatCard({
  title,
  value
}) {

  return (

    <div className="card shadow">

      <div className="card-body">

        <h6>{title}</h6>

        <h2>{value}</h2>

      </div>

    </div>

  );

}