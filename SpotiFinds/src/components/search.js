import React,{Component} from "react";
import {Col, Row, Card, Carousel, Form} from 'react-bootstrap/';
import * as Icon from 'react-bootstrap-icons';

import 'bootstrap/dist/css/bootstrap.min.css';

class search extends Component{
    
    render(){
        return(
            <main role="main" style={{minHeight: '90vh'}}>
                <section>
                    <h1 id="titleSite" style={{color:"#fc3c44", fontSize: "3vh", textAlign: "left", fontWeight:'bold'}}><Icon.SearchHeartFill/> SpotiFinds</h1>
                </section>
                <section>
                    <Form action="Result.js" method="get">
                        <Form.Control id="searchBar" placeholder="Search Music" name="search"/>
                    </Form>

                    <h1 id="searchIcon"><Icon.MusicNoteBeamed/></h1>
                    <p id="searchLabel" className="mx-5 mt-3">Search a music you want to download</p>
                </section>
            </main>
        )
    }
}

export default search;