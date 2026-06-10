import 'bootstrap/dist/css/bootstrap.min.css';
import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";

import Navbar from "./components/Navbar";
import Sidebar from "./components/Sidebar";
import PrivateRoute from "./components/PrivateRoute";

import Login from "./pages/Login";
import Register from "./pages/Register";
import Dashboard from "./pages/Dashboard";
import Laporan from "./pages/Laporan";
import TambahLaporan from "./pages/TambahLaporan";
import EditLaporan from "./pages/EditLaporan";

function MainLayout({ children }) {
  return (
    <>
      <Navbar />
      <div className="d-flex">
        <Sidebar />
        <div className="p-4 w-100">{children}</div>
      </div>
    </>
  );
}

function App() {
  return (
    <BrowserRouter>
      <Routes>

        {/* Halaman publik */}
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />

        {/* Halaman yang butuh login */}
        <Route path="/" element={
          <PrivateRoute><MainLayout><Dashboard /></MainLayout></PrivateRoute>
        } />
        <Route path="/laporan" element={
          <PrivateRoute><MainLayout><Laporan /></MainLayout></PrivateRoute>
        } />
        <Route path="/tambah-laporan" element={
          <PrivateRoute><MainLayout><TambahLaporan /></MainLayout></PrivateRoute>
        } />
        <Route path="/edit-laporan/:id" element={
          <PrivateRoute><MainLayout><EditLaporan /></MainLayout></PrivateRoute>
        } />

        <Route path="*" element={<Navigate to="/" replace />} />

      </Routes>
    </BrowserRouter>
  );
}

export default App;
