import axios from "axios";

const api = axios.create({
  baseURL: "http://localhost/smartcampus_facility/ci3_project/index.php/api/"
});

export default api;