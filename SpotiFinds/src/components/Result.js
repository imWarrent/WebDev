import React,{ useEffect, useState } from "react";
import { useSearchParams, Link } from 'react-router-dom';
import {Col, Row, Spinner, Form, Tab, Tabs} from 'react-bootstrap/';
import * as Icon from 'react-bootstrap-icons';

import 'bootstrap/dist/css/bootstrap.min.css';
import axios from 'axios';

const Result = () => {
    const [searchParams, setSearchParams ] = useSearchParams();
    const options = {
        method: 'GET',
        url: 'https://spotify23.p.rapidapi.com/search/',
        params: {
            q: searchParams.get("search"),
            type: searchParams.get("type"),
            offset: '0',
            limit: '15',
            numberOfTopResults: '10'
        },
        headers: {
            'X-RapidAPI-Key': 'df16178d66mshf3727103ad53dd6p1e9208jsn62315c0dc140',
            'X-RapidAPI-Host': 'spotify23.p.rapidapi.com'
            // 'X-RapidAPI-Key': '2cead3cdf7msh26540121ba73d03p1cd6e1jsn209458e25e2b',
            // 'X-RapidAPI-Host': 'spotify23.p.rapidapi.com'
        }
    };
    const [ isLoaded, setIsLoaded] = useState(false);
    const [ result, setResult ] = useState();

    useEffect(() => {axios
        .request(options)
        .then(function (response) {
        
            if(searchParams.get("type") == "artists"){
                console.log(response.data.artists);
                setResult(response.data.artists);
                setIsLoaded(true);
            }
            else if(searchParams.get("type") == "albums"){
                console.log(response.data.albums);
                setResult(response.data.albums);
                setIsLoaded(true);
            }
            else if(searchParams.get("type") == "playlists"){
                console.log(response.data.playlists);
                setResult(response.data.playlists);
                setIsLoaded(true);
            }
            else{
                console.log(response.data.tracks);
                setResult(response.data.tracks);
                setIsLoaded(true);
            }
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
                    <h1 id="titleSite" style={{color:"#fc3c44", fontSize: "3vh", textAlign: "left", fontWeight:'bold'}}><Icon.SearchHeartFill/> SpotiFinds</h1>
                </section>
                <section>
                    <Form action="Result.js" method="get">
                        <Form.Control id="searchBar" placeholder="Search Music" name="search" defaultValue={searchParams.get("search")}/>
                    </Form>

                    <section id="searchCategory">
                        <Row>
                            <Col xs={3} as={Link} to={`/Result.js?search=${searchParams.get("search")}&type=tracks`} onClick="window.location.reload(false)" className="p-1"><button id="categoryButton">Track</button></Col>
                            <Col xs={3} as={Link} to={`/Result.js?search=${searchParams.get("search")}&type=artists`} onClick="window.location.reload(false)" className="p-1"><button id="categoryButton">Artist</button></Col>
                            <Col xs={3} as={Link} to={`/Result.js?search=${searchParams.get("search")}&type=albums`} onClick="window.location.reload(false)" className="p-1"><button id="categoryButton">Albums</button></Col>
                            <Col xs={3} as={Link} to={`/Result.js?search=${searchParams.get("search")}&type=playlists`} onClick="window.location.reload(false)" className="p-1"><button id="categoryButton">Playlist</button></Col>
                        </Row>
                    </section>

                    
                    {/*Artist*/ searchParams.get("type") === "artists" ? 
                        <section id="tracks" className="px-2">
                        {result?.items.map(post =>

                            <section key={post.id}>
                                <Row id="records" className="rounded">
                                    <Col xs={4} style={{backgroundImage: `url(${post.data.visuals.avatarImage?.sources[0].url})`}} id="recordImg"></Col>
                                    <Col as={Link} to={`/Artist.js?spotifyID=${post.data.uri.slice(15)}`} className="d-flex text-decoration-none justify-content-center align-items-end">
                                        <Row>
                                            <Col xs={12}><h1 id="title">{post.data.profile.name}</h1></Col>
                                            <Col xs={12}><p id="category">Artist</p></Col>
                                        </Row>
                                    </Col>
                                </Row>
                            </section>
                        )}
                    </section> : /*Albums*/ searchParams.get("type") === "albums" ? 
                        <section id="tracks" className="px-2">
                        {result?.items.map(post =>

                            <section key={post.id}>
                                <Row id="records" className="rounded">
                                    <Col xs={4} style={{backgroundImage: `url(${post.data.coverArt.sources[0].url})`}} id="recordImg"></Col>
                                    <Col as={Link} to={`/Albums.js?spotifyID=${post.data.uri.slice(14)}`} className="d-flex text-decoration-none justify-content-center align-items-end">
                                        <Row>
                                            <Col xs={12}><h1 id="title">{post.data.name}</h1></Col>
                                            <Col xs={12}><p id="category">Album <Icon.Dot/> {post.data.artists.items[0].profile.name} </p></Col>
                                        </Row>
                                    </Col>
                                </Row>
                            </section>
                            
                        )}
                    </section> : /*Playlist*/ searchParams.get("type") === "playlists" ? 
                        <section id="tracks" className="px-2">
                        {result?.items.map(post =>

                            <section key={post.id}>
                                <Row id="records" className="rounded">
                                    <Col xs={4} style={{backgroundImage: `url(${post.data.images.items[0].sources[0].url})`}} id="recordImg"></Col>
                                    <Col as={Link} to={`/Playlist.js?spotifyID=${post.data.uri.slice(17)}`} className="d-flex text-decoration-none justify-content-center align-items-end">
                                        <Row>
                                            <Col xs={12}><h1 id="title">{post.data.name}</h1></Col>
                                            <Col xs={12}><p id="category">Playlist <Icon.Dot/> {post.data.owner.name} </p></Col>
                                        </Row>
                                    </Col>
                                </Row>
                            </section>
                            
                        )}
                    </section> :  
                    <section id="tracks" className="px-2">
                        {result?.items.map(post =>

                            <section key={post.id} >
                                <Row id="records" className="rounded">
                                    <Col xs={4} style={{backgroundImage: `url(${post.data.albumOfTrack.coverArt.sources[0].url})`}} id="recordImg"></Col>
                                    <Col as={Link} to={`/Tracks.js?spotifyID=${post.data.id}`} className="d-flex text-decoration-none justify-content-center align-items-end">
                                        <Row>
                                            <Col xs={12}><h1 id="title">{post.data.name}</h1></Col>
                                            <Col xs={12}><p id="category">Song <Icon.Dot/> {post.data.artists.items[0].profile.name} </p></Col>
                                        </Row>
                                    </Col>
                                </Row>
                            </section>
                            
                        )}
                        
                        </section>
                    }
                </section>
            </main>
        )
    }
    
}

export default Result;