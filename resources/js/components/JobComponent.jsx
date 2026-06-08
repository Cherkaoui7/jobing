import React, { useEffect, useState } from "react";
import axios from "axios";

import Sidebar from "./Sidebar";
import SearchResult from "./SearchResult";

export default function JobComponent() {

    const [posts, setPosts] = useState({
        data: [],
    });

    useEffect(() => {
        getJobs();
    }, []);

    const getParameterByName = (name, url) => {

        if (!url) url = window.location.href;

        name = name.replace(/[\[\]]/g, "\\$&");

        const regex = new RegExp(
            "[?&]" + name + "(=([^&#]*)|&|#|$)"
        );

        const results = regex.exec(url);

        if (!results) return null;

        if (!results[2]) return "";

        return decodeURIComponent(
            results[2].replace(/\+/g, " ")
        );
    };

    const getJobs = async (page = 1) => {

        const query = getParameterByName(
            "q",
            window.location.href
        );

        const category = getParameterByName(
            "category_id",
            window.location.href
        );

        try {

            let response;

            if (query !== "" && query !== null) {

                response = await axios.get(
                    `/api/search?q=${query}`
                );

            } else if (
                category !== "" &&
                category !== null
            ) {

                response = await axios.get(
                    `/api/search?category_id=${category}`
                );

            } else {

                response = await axios.get(
                    `/api/search?page=${page}`
                );
            }

            setPosts(response.data);

        } catch (error) {

            console.log(error.message);

            setPosts({
                data: [],
            });
        }
    };

    const getByCategory = async (categoryId) => {

        try {

            const response = await axios.get(
                `/api/search?category_id=${categoryId}`
            );

            setPosts(response.data);

        } catch (error) {

            console.log(error.message);

            setPosts({
                data: [],
            });
        }
    };

    const getByEducation = async (educationLevel) => {

        try {

            const response = await axios.get(
                `/api/search?education_level=${educationLevel}`
            );

            setPosts(response.data);

        } catch (error) {

            console.log(error.message);

            setPosts({
                data: [],
            });
        }
    };

    const getByJobLevel = async (jobLevel) => {

        try {

            const response = await axios.get(
                `/api/search?job_level=${jobLevel}`
            );

            setPosts(response.data);

        } catch (error) {

            console.log(error.message);

            setPosts({
                data: [],
            });
        }
    };

    const getByEmploymentType = async (
        employmentType
    ) => {

        try {

            const response = await axios.get(
                `/api/search?employment_type=${employmentType}`
            );

            setPosts(response.data);

        } catch (error) {

            console.log(error.message);

            setPosts({
                data: [],
            });
        }
    };

    return (

        <div className="job-component">

            <div className="row">

                <div className="col-sm-12 col-md-5 col-xl-4">

                    <Sidebar
                        getByCategory={getByCategory}
                        getByJobLevel={getByJobLevel}
                        getByEmploymentType={getByEmploymentType}
                        getByEducation={getByEducation}
                    />

                </div>

                <div className="col-sm-12 col-md-7 col-xl-8">

                    {posts.data.length < 1 ? (

                        <div>

                            <p className="card-header">
                                No Results
                            </p>

                            <div className="card-body bg-white text-center">

                                <div className="card-text">

                                    <img
                                        src="/images/search-not-found.png"
                                        alt=""
                                    />

                                    <h4>

                                        No Jobs found

                                        <br />

                                        <span className="text-muted">
                                            Please search for another keyword.
                                        </span>

                                    </h4>

                                </div>

                            </div>

                        </div>

                    ) : (

                        <div>

                            <SearchResult
                                posts={posts.data}
                                from={posts.from}
                                to={posts.to}
                                total={posts.total}
                            />

                        </div>

                    )}

                </div>

            </div>

        </div>
    );
}