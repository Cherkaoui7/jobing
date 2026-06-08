import React from "react";

import Home from "./pages/Home";
import Jobs from "./pages/Jobs";
import Organization from "./pages/Organization";

const routes = [
    {
        path: "/",
        element: <Home />
    },
    {
        path: "/jobs",
        element: <Jobs />
    },
    {
        path: "/organization",
        element: <Organization />
    }
];

export default routes;