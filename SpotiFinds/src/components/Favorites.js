import React,{ useEffect, useState } from "react";
import { useSearchParams, Link } from 'react-router-dom';
import {Col, Row, Spinner, Form, Tab, Tabs} from 'react-bootstrap/';
import * as Icon from 'react-bootstrap-icons';

import 'bootstrap/dist/css/bootstrap.min.css';
import axios from 'axios';

const Result = () => {
    let favorites = JSON.parse(localStorage.getItem('favorites'));
    const [searchParams, setSearchParams ] = useSearchParams();
    return(
        <main role="main" style={{minHeight: '90vh'}}>
            <section>
                <h1 id="titleSite" style={{color:"#fc3c44", fontSize: "3vh", textAlign: "left", fontWeight:'bold'}}><Icon.SearchHeartFill/> SpotiFinds</h1>
            </section>
                <Form action="Result.js" method="get">
                    <Form.Control id="searchBar" placeholder="Search Music" name="search" defaultValue={searchParams.get("search")}/>
                </Form>
                <h1 id="sectionLabel">Favorites</h1>
                <section id="tracks" className="px-2">
                    {favorites?.map(post =>

                        <section key={post.id}>
                        <Row id="records" className="rounded">
                            <Col xs={4} style={{backgroundImage: `url(${post.image})`}} id="favImg" className="d-flex justify-content-center align-items-center">
                                <h1 id="trash"><Icon.Trash3Fill/></h1>
                            </Col>
                            <Col as={Link} to={`/Tracks.js?spotifyID=${post.id}`} className="text-decoration-none d-flex justify-content-center align-items-end">
                                <Row>
                                    <Col xs={12}><h1 id="title">{post.title}</h1></Col>
                                    <Col xs={12}><p id="category">{post.artist}</p></Col>
                                </Row>
                            </Col>
                        </Row>
                        </section>
                    )}
                </section>
        </main>
    )
}
export default Result;