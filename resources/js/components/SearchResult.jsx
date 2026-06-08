import React from "react";

export default function SearchResult({
    posts,
    from,
    to,
    total,
}) {

    return (
        <div className="search-result">

            <div className="card mt-md-0 mt-3">

                <div className="card-body row p-3">

                    <div className="col-6">

                        <h1 className="h6" id="job-count">
                            Showing {from} - {to} job of {total}
                        </h1>

                    </div>

                    <div className="col-6">

                        <ul className="nav nav-inline float-right">

                            <li className="nav-item mr-3">

                                <a href="#" className="text-secondary">

                                    <span className="icon-calendar"></span>

                                    Posted:
                                    <span id="date_val">
                                        {" "}
                                        All time
                                    </span>

                                </a>

                            </li>

                        </ul>

                    </div>

                </div>

            </div>

            <div className="posts">

                {posts.map((post) => (

                    <div
                       className="card mt-4 border-0 shadow-sm rounded-4 job-card"
                        key={post.id}
                    >

                        <div className="card-body p-4">

                            <div className="col-sm-12 col-md-12 col-12 col-lg-12">

                                <div className="row align-items-center text-center text-lg-left">

                                    <div className="col-xs-4 col-sm-4 col-md-3 col-lg-3 pt-2 mx-auto">

                                        <img
                                            className="border rounded-4 p-2 img-fluid bg-white"
                                            src={`/${post.company.logo}`}
                                            width="100"
                                            alt=""
                                        />

                                    </div>

                                    <div className="col-xs-12 col-sm-12 col-md-9 col-lg-9 pl-0 pl-md-2 pb-2">

                                        <h5 className="font-weight-bold mb-2">

                                            <a
                                                href={`/job/${post.id}-${post.job_title}`}
                                                target="_blank"
                                                rel="noreferrer"
                                            >
                                                {post.job_title}
                                            </a>

                                        </h5>

                                        <h6 className="mt-2">

                                            <a
                                                href={`/employer/${post.company.id}-${post.company.title}`}
                                                target="_blank"
                                                rel="noreferrer"
                                                className="text-dark"
                                            >
                                                {post.company.title}
                                            </a>

                                        </h6>

                                        <div className="small my-1">

                                            <span>
                                                Address:
                                            </span>

                                            <span>
                                                {post.job_location}
                                            </span>

                                        </div>

                                        <div className="small">

                                            <span className="text-muted">
                                                Key Skills:
                                            </span>

                                            <span className="text-info">
                                                {post.skills}
                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div className="card-footer py-2">

                            <div className="d-inline">

                                <span className="text-muted">

                                    <i className="fas fa-clock"></i>

                                    {" "}Apply Before:

                                    {" "}
                                    {post.deadline.slice(0, -9)}

                                </span>

                            </div>

                            <div className="d-inline float-right">

                                <span className="text-muted mr-2">

                                    <span className="fas fa-eye mr-1"></span>

                                    Views: {post.views}

                                </span>

                            </div>

                        </div>

                    </div>

                ))}

            </div>

        </div>
    );
}
<style jsx="true">{`

.job-card{
    transition:.3s;
}

.job-card:hover{
    transform:translateY(-4px);
    box-shadow:0 15px 35px rgba(0,0,0,.08)!important;
}

.job-card h5 a{
    color:#0f172a;
    font-size:1.2rem;
    text-decoration:none;
}

.job-card h5 a:hover{
    color:#2563eb;
}

.job-card .card-footer{
    background:#f8fafc;
    border-top:1px solid #eef2f7;
}

`}</style>