import React,{ useEffect, useState } from "react";
import { useSearchParams, Link, useNavigate } from 'react-router-dom';
import {Col, Row, Spinner, Form, Breadcrumb, Accordion} from 'react-bootstrap/';
import * as Icon from 'react-bootstrap-icons';

import 'bootstrap/dist/css/bootstrap.min.css';
import axios from 'axios';

const Artist = () => {
    const [searchParams, setSearchParams ] = useSearchParams();
    const [ isLoaded, setIsLoaded] = useState(false);
    const [ isLoadedT, setIsLoadedT] = useState(false);
    const [ result, setResult ] = useState();
    const [ tracks, setTracks ] = useState();

    const navigate = useNavigate();

    const optionsArtist = {
        method: 'GET',
        url: 'https://spotify23.p.rapidapi.com/artist_overview/',
        params: {
            id: searchParams.get('spotifyID'),
        },
        headers: {
            'X-RapidAPI-Key': 'df16178d66mshf3727103ad53dd6p1e9208jsn62315c0dc140',
            'X-RapidAPI-Host': 'spotify23.p.rapidapi.com'
        }
    };

    useEffect(() => {axios
        .request(optionsArtist)
        .then(function (response) {
            //console.log(response.data.data.artist);
            setResult(response.data.data.artist);
            setTracks(response.data.data.artist.discography.topTracks.items)
            setIsLoaded(true);
        }).catch(function (error) {
            console.error(error);
        })}, [])
    
    if(!isLoaded){
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
                        <Form.Control id="searchBar" placeholder="Search Music" name="search"/>
                    </Form>
                    <Row>
                        <Col xs={12}>
                            <section id="artistImage" style={{backgroundImage: `linear-gradient(0deg, rgba(1,1,1,1) 0%, rgba(255,255,255,0) 100%), url(${result.visuals.avatarImage.sources[0].url})`}}>
                                <h1 id='trackTitle'>{result.profile.name}</h1>
                                <p id='trackArtist'>Spotify Artist</p>
                            </section>
                        </Col>
                        <Col xs={12}>
                            <section>
                                <Row>
                                    <Col xs={12} className="d-flex justify-content-start">
                                        <h1 id="discography">Discography</h1>
                                    </Col>
                                    <Col xs={12}>
                                        <section  className="d-flex justify-content-start">
                                            <h1 id="discographyList">Latest Album</h1>
                                        </section>
                                        <section>
                                            <section as={Link} to={`/Playlist.js?spotifyID=${result.discography.latest.id}`} id="latestAlbum" style={{backgroundImage: `linear-gradient(0deg, rgba(1,1,1,1) 0%, rgba(255,255,255,0) 100%), url(${result.discography.latest.coverArt.sources[0].url})`}}>
                                                <h1 id='trackTitle'>{result.discography.latest.name}</h1>
                                                <p id='trackArtist'>{result.discography.latest.date.year}<Icon.Dot/>{result.discography.latest.label}</p>
                                            </section>
                                        </section>
                                        <section  className="d-flex justify-content-start">
                                            <h1 id="discographyList">Top Singles</h1>
                                        </section>
                                        <section id="tracks" className="px-2">
                                            {tracks?.map(post =>
                                                <section key={post.id} >
                                                    <Row id="records" className="rounded">
                                                        <Col xs={4} style={{backgroundImage: `url(${post.track.album.coverArt.sources[0].url})`}} id="recordImg"></Col>
                                                        <Col as={Link} to={`/Tracks.js?spotifyID=${post.track.id}`} className="d-flex text-decoration-none justify-content-center align-items-end">
                                                            <Row>
                                                                <Col xs={12}><h1 id="title">{post.track.name} </h1></Col>
                                                                <Col xs={12}><p id="category">Play Counts <Icon.Dot/>{post.track.playcount}</p></Col>
                                                            </Row>
                                                        </Col>
                                                    </Row>
                                                </section>
                                            )}
                                        </section>
                                    </Col>
                                </Row>
                                
                                
                            </section>
                        </Col>

                    </Row>
                    
            </main>
        )
    }
}

export default Artist;