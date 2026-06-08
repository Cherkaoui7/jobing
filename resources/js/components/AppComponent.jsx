import React from "react";

import SearchBar from "./SearchBar";
import JobComponent from "./JobComponent";

export default function AppComponent() {

    return (

        <div className="app-component mb-5">

            <div className="container-fluid px-0 mb-2">

                <SearchBar />

            </div>

            <div className="container">

                <JobComponent />

            </div>

        </div>

    );
}