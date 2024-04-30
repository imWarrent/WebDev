import React,{Component} from "react";
import {Col, Row} from 'react-bootstrap/';
import * as Icon from 'react-bootstrap-icons';
import { BrowserRouter as Router,  Routes, Route, Link } from 'react-router-dom';

import 'bootstrap/dist/css/bootstrap.min.css';
import './main.css';

import Home from "./home";
import Search from "./search";
import Result from "./Result";
import Tracks from "./Tracks.js";
import Favorites from "./Favorites.js";
import Albums from "./Albums.js";
import Playlist from "./Playlist.js";
import Artist from "./Artist.js";

class NavBarComp extends Component{
    
    render(){
        return(
            <Router>
                <div className="fixed-bottom" id="navBar">
                    <Row>
                        <Col as={Link} to={"/Home"} id="navBarButtons"><Icon.HouseFill id="navIcon"/><p id="navButtonsLabel">Home</p></Col>
                        <Col as={Link} to={"/Search"} id="navBarButtons"><Icon.SearchHeartFill id="navIcon"/><p id="navButtonsLabel">Search</p></Col>
                        <Col as={Link} to={"/Favorites"} id="navBarButtons"><Icon.HeartFill id="navIcon"/><p id="navButtonsLabel">Favorites</p></Col>
                    </Row>
                </div>

                <Routes>
                    <Route path="/Home" element={<Home/>}>
                    </Route>
                    <Route path="/Search" element={<Search/>}>
                    </Route>
                    <Route path="/Favorites" element={<Favorites/>}>
                    </Route>
                    <Route path="/Result:param" element={<Result/>}>
                    </Route>
                    <Route path="/Tracks:param" element={<Tracks/>}>
                    </Route>
                    <Route path="/Albums:param" element={<Albums/>}>
                    </Route>
                    <Route path="/Playlist:param" element={<Playlist/>}>
                    </Route>
                    <Route path="/Artist:param" element={<Artist/>}>
                    </Route>
                </Routes>
            </Router>
        )
    }
}

export default NavBarComp;