import React from 'react'
import './App.css'
import 'bootstrap/dist/css/bootstrap.min.css'
import Container from 'react-bootstrap/Container'
import ContactForm from './components/ContactForm'
import {CardImg} from 'react-bootstrap'
import headerImg from './images/header.png'

function App() {
  return (
    <div className='App'>
      <header className='App-header'>
        <CardImg src={headerImg}/>
        <Container>
          <ContactForm/>
        </Container>
      </header>
    </div>
  )
}

export default App
