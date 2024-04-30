import React,{ useEffect, useState } from "react";
import { useSearchParams, Link, useNavigate } from 'react-router-dom';
import {Col, Row, Spinner, Form} from 'react-bootstrap/';
import * as Icon from 'react-bootstrap-icons';

import 'bootstrap/dist/css/bootstrap.min.css';
import axios from 'axios';
import { Button } from "bootstrap";

const Tracks = () => {
    const [searchParams, setSearchParams ] = useSearchParams();
    const navigate = useNavigate();
    
    let favorites = [];
    if(localStorage.getItem('favorites') != null){
        favorites = JSON.parse(localStorage.getItem('favorites'));
    }

    let isFav = favorites.find(o => o.id === searchParams.get('spotifyID')) != null;
    //alert((isFav == null) + " " + searchParams.get("spotifyID") + " " + favorites[favorites.length - 1].id);

    const options = {
        method: 'GET',
        url: 'https://spotify23.p.rapidapi.com/tracks/',
        params: {
            ids: searchParams.get("spotifyID"),
        },
        headers: {
            'X-RapidAPI-Key': 'df16178d66mshf3727103ad53dd6p1e9208jsn62315c0dc140',
            'X-RapidAPI-Host': 'spotify23.p.rapidapi.com'
        }
    };

    const lyricsOption = {
        method: 'GET',
        url: 'https://spotify23.p.rapidapi.com/track_lyrics/',
        params: {
            id: searchParams.get("spotifyID"),
        },
        headers: {
            'X-RapidAPI-Key': 'df16178d66mshf3727103ad53dd6p1e9208jsn62315c0dc140',
            'X-RapidAPI-Host': 'spotify23.p.rapidapi.com'
        }
    }

    const downloadOption = {
        method: 'GET',
        url: 'https://spotify-downloader.p.rapidapi.com/SpotifyDownloader',
        params: {
            url: 'https://open.spotify.com/track/'+searchParams.get("spotifyID"),
        },
        headers: {
            'X-RapidAPI-Key': '2cead3cdf7msh26540121ba73d03p1cd6e1jsn209458e25e2b',
            'X-RapidAPI-Host': 'spotify-downloader.p.rapidapi.com'
        }
    };

    const [ isLoaded, setIsLoaded] = useState(false);
    const [ isLoadedL, setIsLoadedL] = useState(false);
    const [ isLoadedD, setIsLoadedD] = useState(false);
    const [ result, setResult ] = useState();
    const [ lyrics, setLyrics ] = useState();
    const [ download, setDownload ] = useState();

    //TRACKS
    useEffect(() => {axios
        .request(options)
        .then(function (response) {
            setIsLoaded(true);
            console.log(response.data);
            setResult(response.data);
        }).catch(function (error) {
            console.error(error);
        })}, [])

    //LYRICS
    useEffect(() => {axios
        .request(lyricsOption)
        .then(function (response) {
            setIsLoadedL(true);
            console.log(response.data.lyrics.lines);
            setLyrics(response.data.lyrics.lines);
    }).catch(function (error) {
        console.error(error);
    })}, [])


    //DOWNLOADER
    useEffect(() => {axios
        .request(downloadOption)
        .then(function (response) {
            setIsLoadedD(true);
            console.log(response.data.audio.url);
            setDownload(response.data.audio.url);
    }).catch(function (error) {
        console.error(error);
    })}, [])
    
    if(!isLoaded || !isLoadedL || !isLoadedD){
        return(
            <main role="main" style={{minHeight: '90vh'}}>
                <section>
                    <h1 id="titleSite" style={{color:"#fc3c44", fontSize: "3vh", textAlign: "left", fontWeight:'bold'}}><Icon.SearchHeartFill/> SpotiFinds</h1>
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
                        <p className="mt-4">Fetching Tracks Data</p>
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
                
                    <Row>
                        <Col xs={12}>
                            <section id="trackImage" style={{backgroundImage: `linear-gradient(0deg, rgba(1,1,1,1) 0%, rgba(255,255,255,0) 100%), url(${result.tracks[0].album?.images[0].url})`}}>
                                <button onClick={actionFav} id='trackFavorite'>{isFav ? 'REMOVE TO FAVORITES' : 'ADD TO FAVORITES'}</button>

                                <h1 onClick={play} id='play'><Icon.PlayFill/></h1>
                                <h1 onClick={pause} id='pause'><Icon.PauseFill/></h1>
                                <audio id="audio" onPause={showPlay}>
                                    <source src={result.tracks[0].preview_url}/>
                                </audio>


                                <h1 id='trackTitle'>{result.tracks[0].name}</h1>
                                <input type="hidden" value={searchParams.get("spotifyID")} id="spotifyID"/>
                                <input type="hidden" value={result.tracks[0].album.images[0].url} id="spotifyImage"/>
                                <p id='trackArtist'>Artist - {result.tracks[0].artists[0].name}</p>
                            </section>
                        </Col>
                        <Col>
                            <Row id="trackInfo">
                                <Col xs={12}>
                                    <button id="trackButton" onClick={showLyrics} style={{backgroundColor: '#845EC2'}}><Icon.MusicNoteBeamed/> Show Lyrics</button>
                                </Col>
                                <Col xs={12}>
                                    <a href={download}><button id="trackButton" style={{backgroundColor: '#0089BA'}}><Icon.CloudDownloadFill/> Download MP3</button></a>
                                </Col>
                                <Col xs={12}>
                                    <a href={result.tracks[0].external_urls.spotify}><button id="trackButton" style={{backgroundColor: '#1DB954'}}><Icon.Spotify/> Stream on Spotify</button></a>
                                </Col>
                            </Row>
                        </Col>
                        <Col xs={12}>
                        <section id="trackLyrics" className="mt-3" style={{width: '100%'}}>
                                <h1 onClick={hideLyrics} className="mb-3" style={{color: 'Black'}}><Icon.MusicNoteList/></h1>
                                <h1 className="mb-3" style={{color: 'Black'}}>Lyrics</h1>
                            {lyrics?.map(lines => 
                                <p key={lines.id}>
                                    {lines.words}
                                </p>
                                
                            )}
                            <button onClick={hideLyrics}  id="lyricsButton">Hide Lyrics</button>
                        </section>
                        </Col>
                    </Row>
            </main>
        )
    }
    
}

function play(){
    var audio = document.getElementById('audio');
    audio.play();
    document.getElementById("play").style.display = 'none';
    document.getElementById("pause").style.display = 'block';
}

function pause(){
    var audio = document.getElementById('audio');
    audio.pause();
    document.getElementById("play").style.display = 'block';
    document.getElementById("pause").style.display = 'none';
}

function showLyrics(){
    document.getElementById("trackImage").style.height = '20vh';
    document.getElementById("trackInfo").style.height = '0vh';
    document.getElementById("trackLyrics").style.padding = '3vh';
    document.getElementById("trackLyrics").style.height = 'auto';
    document.getElementById("play").style.display = 'none';
    document.getElementById("pause").style.display = 'none';
}

function hideLyrics(){
    var audio = document.getElementById('audio');
    document.getElementById("trackImage").style.height = '50vh';
    document.getElementById("trackInfo").style.height = 'auto';
    document.getElementById("trackLyrics").style.padding = '0';
    document.getElementById("trackLyrics").style.height = '0';

    if(audio.duration > 0 && !audio.paused){
        document.getElementById("pause").style.display = 'block';
        document.getElementById("play").style.display = 'none';
    }
    else{
        document.getElementById("play").style.display = 'block';
        document.getElementById("pause").style.display = 'none';
    }
}

function showPlay(){
    document.getElementById("play").style.display = 'block';
    document.getElementById("pause").style.display = 'none';
}

function actionFav(){
    let x = document.getElementById('trackFavorite').innerHTML;
    if(x == 'REMOVE TO FAVORITES'){
        document.getElementById('trackFavorite').innerHTML = 'ADD TO FAVORITES'
        removeFav()
        alert("Removed to favorites!")
    }
    else if (x == 'ADD TO FAVORITES'){
        document.getElementById('trackFavorite').innerHTML = 'REMOVE TO FAVORITES'
        addFav()
        alert("Added to favorites!")
    }
}

function addFav(){
    let id = document.getElementById("spotifyID").value;
    let title = document.getElementById("trackTitle").innerHTML;
    let artist = document.getElementById("trackArtist").innerHTML;
    let image = document.getElementById("spotifyImage").value;

    let favorites = [];
    if(localStorage.getItem('favorites') == null){
        favorites.push({"id":id,"image":image,"title":title,"artist":artist});
        localStorage.setItem('favorites', JSON.stringify(favorites));
    }else{
        favorites = JSON.parse(localStorage.getItem('favorites'));
        let index = favorites.findIndex(item => item.id === id);
        if(index < 0){
            favorites.push({"id":id,"image":image,"title":title,"artist":artist});
            localStorage.setItem('favorites', JSON.stringify(favorites));
        }
    }
}

function removeFav(){
    let id = document.getElementById("spotifyID").value;
    let favorites = JSON.parse(localStorage.getItem('favorites'));
    let index = favorites.findIndex(item => item.id === id);

    if(index > -1){
        favorites.splice(index, 1);
        localStorage.setItem('favorites', JSON.stringify(favorites));
    }
}
export default Tracks;