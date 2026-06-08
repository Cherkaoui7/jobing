import React, { useEffect, useState } from "react";
import axios from "axios";

export default function Sidebar({
    getByCategory,
    getByJobLevel,
    getByEmploymentType,
    getByEducation,
}) {

    const [categories, setCategories] = useState([]);

    useEffect(() => {
        setCategoies();
    }, []);

    const setCategoies = async () => {

        try {

            const response = await axios.get(
                "/api/company-categories"
            );

            setCategories(response.data);

        } catch (error) {

            console.log(error.message);

        }
    };

    return (
        <div>

            <div className="card border-0 shadow-sm rounded-4">

                <div className="card-body p-3">

                    <div className="d-flex align-items-center small mb-0">

                        <i className="fas fa-search mr-1"></i>

                        <strong>
                            Refine Your Job Search
                        </strong>

                    </div>

                </div>

            </div>

            <div id="accordion">

                <div className="card border-0 rounded-4 shadow-sm mt-3">

                    <div className="card-body p-3" id="jobCategories">

                        <div className="pb-0">

                            <div className="card-title mb-1">
                                Job Categories
                            </div>

                            <div className="card-body p-0">

                                <div className="form-group">

                                    <select
                                        className="form-control rounded-3 modern-select"
                                        onChange={(e) =>
                                            getByCategory(
                                                e.target.value
                                            )
                                        }
                                    >

                                        <option value="">
                                            -- select an option --
                                        </option>

                                        {categories.map((category) => (

                                            <option
                                                value={category.id}
                                                key={category.id}
                                            >
                                                {category.category_name}
                                            </option>

                                        ))}

                                    </select>

                                </div>

                            </div>

                        </div>

                        <hr className="my-3" />

                        <div className="pb-0">

                            <div className="card-title mb-1">
                                Job Level
                            </div>

                            <div className="card-body p-0">

                                <div className="form-group">

                                    <select
                                      className="form-control rounded-3 modern-select"
                                        onChange={(e) =>
                                            getByJobLevel(
                                                e.target.value
                                            )
                                        }
                                    >

                                        <option value="">
                                            -- select an option --
                                        </option>

                                        <option value="Senior level">
                                            Senior level
                                        </option>

                                        <option value="Mid level">
                                            Mid level
                                        </option>

                                        <option value="Top level">
                                            Top level
                                        </option>

                                        <option value="Entry level">
                                            Entry level
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <hr className="my-3" />

                        <div className="pb-0">

                            <div className="card-title mb-1">
                                Education
                            </div>

                            <div className="card-body p-0">

                                <div className="form-group">

                                    <select
                                      className="form-control rounded-3 modern-select"
                                        onChange={(e) =>
                                            getByEducation(
                                                e.target.value
                                            )
                                        }
                                    >

                                        <option value="">
                                            -- select an option --
                                        </option>

                                        <option value="Bachelors">
                                            Bachelors
                                        </option>

                                        <option value="High School">
                                            High School
                                        </option>

                                        <option value="Master">
                                            Master
                                        </option>

                                        <option value="SEE Mid School">
                                            SEE Mid School
                                        </option>

                                        <option value="Other">
                                            Other
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <hr className="my-3" />

                        <div className="pb-0">

                            <div className="card-title mb-1">
                                Employment Type
                            </div>

                            <div className="card-body p-0">

                                <div className="form-group">

                                    <select
                                      className="form-control rounded-3 modern-select"
                                        onChange={(e) =>
                                            getByEmploymentType(
                                                e.target.value
                                            )
                                        }
                                    >

                                        <option value="">
                                            -- select an option --
                                        </option>

                                        <option value="Full Time">
                                            Full Time
                                        </option>

                                        <option value="Part Time">
                                            Part Time
                                        </option>

                                        <option value="Freelance">
                                            Freelance
                                        </option>

                                        <option value="Internship">
                                            Internship
                                        </option>

                                        <option value="Trainneship">
                                            Trainneship
                                        </option>

                                        <option value="Volunter">
                                            Volunter
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    );
}

<style jsx="true">{`

.modern-select{
    height:48px;
    border:1px solid #e2e8f0;
    box-shadow:none!important;
}

.modern-select:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 4px rgba(37,99,235,.1)!important;
}

`}</style>