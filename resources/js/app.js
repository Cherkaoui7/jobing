require("./bootstrap");

import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter as Router } from "react-router-dom";

import AppComponent from "./components/AppComponent.jsx";

const appElement = document.getElementById("app");
if (appElement) {
    const root = ReactDOM.createRoot(appElement);
    root.render(
        <Router>
            <AppComponent />
        </Router>
    );
}