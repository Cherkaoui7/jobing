require("./bootstrap");

import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter as Router } from "react-router-dom";

import AppComponent from "./components/AppComponent.jsx";

const root = ReactDOM.createRoot(document.getElementById("app"));

root.render(
    <Router>
        <AppComponent />
    </Router>
);