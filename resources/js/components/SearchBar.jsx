import React, { useEffect, useState } from "react";

export default function SearchBar() {

    const [jobTitle, setJobTitle] = useState("");

    useEffect(() => {
        const q = getParameterByName("q", window.location.href);

        if (q !== "") {
            setJobTitle(q);
        }
    }, []);

    const searchByTitle = (e) => {
        e.preventDefault();

        if (jobTitle.trim() !== "") {
            window.location.href = `/search?q=${jobTitle}`;
        }
    };

    const getParameterByName = (name, url) => {
        if (!url) url = window.location.href;

        name = name.replace(/[\[\]]/g, "\\$&");

        const regex = new RegExp(
            "[?&]" + name + "(=([^&#]*)|&|#|$)"
        );

        const results = regex.exec(url);

        if (!results) return null;

        if (!results[2]) return "";

        return decodeURIComponent(results[2].replace(/\+/g, " "));
    };

    return (
        <section
            className="search-bar mt-2 px-0"
            style={{ backgroundColor: "#f5fdff" }}
        >
            <div className="py-4">

                <div className="row">

                    <div className="col-md-6 offset-md-3">

                        <form onSubmit={searchByTitle}>

                            <div className="row m-1">

                                <div className="col-md-12 input-group">

                                    <input
                                        type="text"
                                        name="q"
                                        className="form-control"
                                        placeholder="Search By Job Title"
                                        value={jobTitle}
                                        onChange={(e) =>
                                            setJobTitle(e.target.value)
                                        }
                                    />

                                    <span className="input-group-append">

                                        <button
                                            className="btn btn-success pt-1"
                                            type="submit"
                                        >
                                            Search Jobs
                                        </button>

                                    </span>

                                </div>

                            </div>

                        </form>

                    </div>

                    <div className="col-sm-12 col-md-6 offset-md-3 small text-center my-2">

                        <div className="row">

                            <div className="col-sm-6 col-md-3">
                                <a href="/search">All Jobs</a>
                            </div>

                            <div className="col-sm-6 col-md-3">
                                <a href="/search#/jobs-by-organization">
                                    By Organisation
                                </a>
                            </div>

                            <div className="col-sm-6 col-md-3">
                                <a href="/search#/jobs-by-category">
                                    By Job Category
                                </a>
                            </div>

                            <div className="col-sm-6 col-md-3">
                                <a href="/search#/jobs-by-title">
                                    By Job Title
                                </a>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </section>
    );
}