import React,{ useEffect, useState } from "react";
import { useSearchParams, Link, useNavigate } from 'react-router-dom';
import {Col, Row, Spinner, Form, Breadcrumb} from 'react-bootstrap/';
import * as Icon from 'react-bootstrap-icons';

import 'bootstrap/dist/css/bootstrap.min.css';
import axios from 'axios';

const Result = () => {
    const [searchParams, setSearchParams ] = useSearchParams();
    const navigate = useNavigate();
    const options = {
        method: 'GET',
        url: 'https://spotify23.p.rapidapi.com/playlist/',
        params: {
            id: searchParams.get('spotifyID'),
        },
        headers: {
            'X-RapidAPI-Key': 'df16178d66mshf3727103ad53dd6p1e9208jsn62315c0dc140',
            'X-RapidAPI-Host': 'spotify23.p.rapidapi.com'
        }
    };
    const optionsTrack = {
        method: 'GET',
        url: 'https://spotify23.p.rapidapi.com/playlist_tracks/',
        params: {
            id: searchParams.get('spotifyID'), 
            offset: '0', 
            limit: '15'},
        headers: {
            'X-RapidAPI-Key': 'df16178d66mshf3727103ad53dd6p1e9208jsn62315c0dc140',
            'X-RapidAPI-Host': 'spotify23.p.rapidapi.com'
        }
    };

    const [ isLoaded, setIsLoaded] = useState(false);
    const [ isLoadedT, setIsLoadedT] = useState(false);
    const [ result, setResult ] = useState();
    const [ tracks, setTracks ] = useState();

    useEffect(() => {axios
        .request(options)
        .then(function (response) {
            setIsLoaded(true);
            console.log(response.data);
            setResult(response.data);
        }).catch(function (error) {
            console.error(error);
        })}, [])
    
    useEffect(() => {axios
        .request(optionsTrack)
        .then(function (response) {
            setIsLoadedT(true);
            console.log(response.data.items);
            setTracks(response.data.items);
        }).catch(function (error) {
            console.error(error);
        })}, [])
    
    if(!isLoaded || !isLoadedT){
        return(
            <main role="main" style={{minHeight: '90vh'}}>
                <section>
                    <h1 style={{color:"#fc3c44", fontSize: "3vh", textAlign: "left", fontWeight:'bold'}}><Icon.SearchHeartFill/> SpotiFinds</h1>
                </section>
                <section>
                    <Form action="Result.js" method="get">
                        <Form.Control id="searchBar" placeholder="Search Music" name="search" defaultValue={searchParams.get("search")}/>
                    </Form>
                </section>
                <section className="mt-5">
                    <center>
                        <Spinner animation="border" role="status">
                        <span className="visually-hidden">Loading...</span>
                        </Spinner>
                        <p className="mt-4">Searching {searchParams.get("type")}</p>
                    </center>
                </section>
            </main>
        )
    }
    else{
        return(
            <main role="main" style={{minHeight: '90vh'}}>
                <section>
                    <Row>
                        <Col onClick={() => navigate(-1)}>
                            <h1 style={{color:"#fc3c44", fontSize: "3.5vh", textAlign: "left", fontWeight:'bold'}}><Icon.ArrowLeftCircleFill/></h1> 
                        </Col>
                        <Col>
                            <h1 style={{color:"#fc3c44", fontSize: "3vh", textAlign: "right", fontWeight:'bold'}}><Icon.SearchHeartFill/> SpotiFinds</h1>
                        </Col>
                    </Row>
                </section>
                    <Form action="Result.js" method="get">
                        <Form.Control id="searchBar" placeholder="Search Music" name="search" defaultValue={searchParams.get("search")}/>
                    </Form>
                    <Row>
                        <Col xs={12}>
                            <section id="albumImage" style={{backgroundImage: `linear-gradient(0deg, rgba(1,1,1,1) 0%, rgba(255,255,255,0) 100%), url(${result.images[0].url})`}}>
                                <h1 id='trackTitle'>{result.name}</h1>
                                <p id='trackArtist'>Playlist</p>
                            </section>
                        </Col>

                    </Row>
                    <section id="tracks" className="px-2">
                        {tracks?.map(post =>
                            <section key={post.id} >
                                <Row id="records" className="rounded">
                                    <Col xs={4} style={{backgroundImage: `url(${post.track.album.images[0].url})`}} id="recordImg"></Col>
                                    <Col as={Link} to={`/Tracks.js?spotifyID=${post.track.id}`} className="d-flex text-decoration-none justify-content-center align-items-end">
                                        <Row>
                                            <Col xs={12}><h1 id="title">{post.track.name}</h1></Col>
                                            <Col xs={12}><p id="category">Song <Icon.Dot/>{post.track.album.artists[0].name}</p></Col>
                                        </Row>
                                    </Col>
                                </Row>
                            </section>
                        )}
                    </section>
            </main>
        )
    }
}

export default Result;