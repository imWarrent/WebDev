import React,{ useEffect, useState } from "react";
import {Col, Row, Spinner} from 'react-bootstrap/';
import * as Icon from 'react-bootstrap-icons';
import { BrowserRouter as Router,  Routes, Route, Link } from 'react-router-dom';

import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';

const Home = () => {
    const [ result, setResult ] = useState();
    const [ isLoaded, setIsLoaded] = useState(false);

    const optionsTrack = {
        method: 'GET',
        url: 'https://spotify23.p.rapidapi.com/playlist_tracks/',
        params: {
            id: '05yxsbRwtAWWxP1dGuvZM1', 
            offset: '0', 
            limit: '15'},
        headers: {
            'X-RapidAPI-Key': 'df16178d66mshf3727103ad53dd6p1e9208jsn62315c0dc140',
            'X-RapidAPI-Host': 'spotify23.p.rapidapi.com'
        }
    };

    useEffect(() => {axios
        .request(optionsTrack)
        .then(function (response) {
            setIsLoaded(true);
            console.log(response.data.items[0].track);
            setResult(response.data);
        }).catch(function (error) {
            console.error(error);
        })}, [])
    

    if(!isLoaded){
        return(
            <main role="main" style={{minHeight: '90vh'}}>
                <section>
                    <h1 id="titleSite" style={{color:"#fc3c44", fontSize: "3vh", textAlign: "left", fontWeight:'bold'}}><Icon.SearchHeartFill/> SpotiFinds</h1>
                </section>
                <section className="mt-5">
                    <center>
                        <Spinner animation="border" role="status">
                        <span className="visually-hidden">Loading...</span>
                        </Spinner>
                        <p className="mt-4">Loading Home</p>
                    </center>
                </section>
            </main>
        )
    }
    else{
        return(
            <main role="main">
                <section>
                    <h1 style={{color:"#fc3c44", fontSize: "3vh", textAlign: "left", fontWeight:'bold'}}><Icon.SearchHeartFill/> SpotiFinds</h1>
                </section>
                <section>
                    <Row>
                        <Col as={Link} to={`/Tracks.js?spotifyID=${result.items[0].track.id}`} className="text-decoration-none">
                            <section id="featuredImage" style={{backgroundImage: `linear-gradient(0deg, rgba(1,1,1,1) 0%, rgba(255,255,255,0) 100%), url(${result.items[0].track.album.images[0].url})`}}>
                                <h1 id='featuredArtist'>{result.items[0].track.name}</h1>
                                <p id='featuredArtist2'>Recommended for you</p>
                            </section>
                        </Col>
                    </Row>
                </section>
                <Row>
                    <Col xs={6} as={Link} to={"/Playlist.js?spotifyID=37i9dQZF1DX2L0iB23Enbq"} className="text-decoration-none">
                        <section id="smallPanels" style={{backgroundImage: "linear-gradient(0deg, rgba(1,1,1,1) 0%, rgba(255,255,255,0) 100%), url('https://c4.wallpaperflare.com/wallpaper/831/167/802/taylor-swift-music-celebrities-singer-wallpaper-preview.jpg')"}}>
                            <h1 id='smallPanel'>VIRAL HITS</h1>
                        </section>
                    </Col>
                    <Col xs={6} as={Link} to={"/Playlist.js?spotifyID=593HKP3qHQXS0RLZmeeHly"} className="text-decoration-none">
                        <section id="smallPanels" style={{backgroundImage: "linear-gradient(0deg, rgba(1,1,1,1) 0%, rgba(255,255,255,0) 100%), url('https://c4.wallpaperflare.com/wallpaper/1004/4/846/synthwave-background-wallpaper-preview.jpg')"}}>
                            <h1 id='smallPanel'>NEW RELEASE</h1>
                        </section>
                    </Col>
                    <Col xs={6} as={Link} to={"/Playlist.js?spotifyID=7plMuiBtCwKC0xVTdOOrX8"} className="text-decoration-none">
                        <section id="smallPanels" style={{backgroundImage: "linear-gradient(0deg, rgba(1,1,1,1) 0%, rgba(255,255,255,0) 100%), url('https://www.mordeo.org/files/uploads/2022/05/Justin-Bieber-On-Stage-Singing-4K-Ultra-HD-Mobile-Wallpaper.jpg')"}}>
                            <h1 id='smallPanel'>POP</h1>
                        </section>
                    </Col>
                    <Col xs={6} as={Link} to={"/Playlist.js?spotifyID=37i9dQZF1DX9tPFwDMOaN1"} className="text-decoration-none">
                        <section id="smallPanels" style={{backgroundImage: "linear-gradient(0deg, rgba(1,1,1,1) 0%, rgba(255,255,255,0) 100%), url('https://dbkpop.com/wp-content/uploads/2022/02/nmixx_ad_mare_teaser_MIXX_all_group_1.jpg')"}}>
                            <h1 id='smallPanel'>KPOP</h1>
                        </section>
                    </Col>
                    <Col xs={6} as={Link} to={"/Playlist.js?spotifyID=37i9dQZF1DX0iFfuXuP4Pm"} className="text-decoration-none">
                        <section id="smallPanels" style={{backgroundImage: "linear-gradient(0deg, rgba(1,1,1,1) 0%, rgba(255,255,255,0) 100%), url('https://mb.com.ph/wp-content/uploads/2021/08/The-Juans-official-photo-from-Viva-Records-2-768x1024.png')"}}>
                            <h1 id='smallPanel'>OPM</h1>
                        </section>
                    </Col>
                    <Col xs={6} as={Link} to={"/Playlist.js?spotifyID=37i9dQZF1DX0XUsuxWHRQd"} className="text-decoration-none">
                        <section id="smallPanels" style={{backgroundImage: "linear-gradient(0deg, rgba(1,1,1,1) 0%, rgba(255,255,255,0) 100%), url('https://wallpaperaccess.com/full/29967.jpg')"}}>
                            <h1 id='smallPanel'>HIP-HOP</h1>
                        </section>
                    </Col>
                </Row>
            </main>
        )
    }
}

export default Home;