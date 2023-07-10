import React from "react";
import ReactDOM from "react-dom/client";
import App from "./App.tsx";
// import "./index.css";
import Dashboard from "./Dashboard.tsx";

ReactDOM.createRoot(document.getElementById("root")!).render(
    <React.StrictMode>
        <App />
        {/* <Dashboard /> */}
    </React.StrictMode>
);
