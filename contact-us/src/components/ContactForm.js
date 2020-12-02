import React, {Component} from 'react'
import {Button, CardImg} from 'react-bootstrap'
import btnSubmitUrl from '../images/btn.png'
import {
    Row,
    Form,
    Col,
    FormControl,
    FormGroup,
    InputGroup,
    FormText
} from 'react-bootstrap'

class ContactForm extends Component {
    state = {
        firstName: '',
        lastName: '',
        phone: '',
        email: '',
        street: '',
        number: '',
        city: '',
        postalCode: ''
    }

    //Handle Change
    handleChange = FormControl => e => {
        this.setState({[FormControl]: e.target.value})
    }

    //Submit Form
    submitForm = (e) => {
        const {
            firstName,
            lastName,
            phone,
            email,
            street,
            number,
            city,
            postalCode
        } = this.state

        var xhr = new XMLHttpRequest();

        //Server Responds Callback
        xhr.addEventListener('load', () => {
            //console.log(xhr.responseText)
            this.setState({emailStatus: xhr.responseText})
        });

        var uri = `http://localhost:80/sendemail/index.php?&sendto=${email}&firstName=${firstName}&lastName=${lastName}&phone=${phone}&street=${street}&number=${number}&city=${city}&postalCode=${postalCode}&utm_source=test&utm_medium=project&ref=10`

        xhr.open('POST', uri);
        xhr.onreadystatechange = this.handleChange;
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        // send the request
        xhr.send(uri);
        console.log(this.state);

        // reset the fields
        this.setState({
            firstName: '',
            lastName: '',
            phone: '',
            email: '',
            street: '',
            number: '',
            city: '',
            postalCode: ''
        });
        e.preventDefault();
    }

    render() {
        const {
            firstName,
            lastName,
            phone,
            email,
            street,
            number,
            city,
            postalCode,
            emailStatus
        } = this.state

        return (
            <div className="formBlock" onSubmit={this.submitForm}>

                <Form className='form'>
                    <FormGroup>
                        <h2>לקבלת דוגמית חינם</h2>
                        <h2>מלאו את הפרטים:</h2>
                        {emailStatus
                            ? emailStatus
                            : null}
                    </FormGroup>
                    <FormGroup>
                        <FormText
                            style={{
                            display: 'flex'
                        }}>*שדה חובה</FormText>
                    </FormGroup>
                    <FormGroup>
                        <Row>
                            <Col className='pl-1'>
                                <FormControl
                                    type="text"
                                    placeholder='*שם פרטי'
                                    className='rounded-0'
                                    value={firstName}
                                    onChange={this.handleChange('firstName')}/>
                            </Col>
                            <Col className='pr-1'>
                                <FormControl
                                    type="text"
                                    placeholder='*שם משפחה'
                                    className='rounded-0'
                                    value={lastName}
                                    onChange={this.handleChange('lastName')}/>
                            </Col>
                        </Row>
                    </FormGroup>
                    <FormGroup>
                        <Row>
                            <Col>
                                <FormControl
                                    type="tel"
                                    placeholder='*נייד'
                                    className='rounded-0'
                                    value={phone}
                                    onChange={this.handleChange('phone')}/>
                            </Col>
                        </Row>
                    </FormGroup>
                    <FormGroup>
                        <Row>
                            <Col>
                                <FormControl
                                    type="email"
                                    placeholder='*מייל'
                                    className='rounded-0'
                                    value={email}
                                    onChange={this.handleChange('email')}/>
                            </Col>
                        </Row>
                    </FormGroup>
                    <FormGroup>
                        <Row>
                            <Col xs={8} className="pl-1">
                                <FormControl
                                    type="text"
                                    placeholder='*רחוב'
                                    className='rounded-0'
                                    value={street}
                                    onChange={this.handleChange('street')}/>
                            </Col>
                            <Col xs={4} className='pr-1'>
                                <FormControl
                                    type="text"
                                    placeholder="*מס' בית"
                                    className='rounded-0'
                                    value={number}
                                    onChange={this.handleChange('number')}/>
                            </Col>
                        </Row>
                    </FormGroup>
                    <FormGroup>
                        <Row>
                            <Col className='pl-1'>
                                <FormControl
                                    type="text"
                                    placeholder="*עיר"
                                    className='rounded-0'
                                    value={city}
                                    onChange={this.handleChange('city')}/>
                            </Col>
                            <Col className='pr-1'>
                                <FormControl
                                    type="text"
                                    placeholder="מיקוד"
                                    className='rounded-0'
                                    value={postalCode}
                                    onChange={this.handleChange('postalCode')}/>
                            </Col>
                        </Row>
                    </FormGroup>
                    <div>
                        <InputGroup>
                            <Row>
                                <Col xs="1">
                                    <InputGroup.Prepend>
                                        <InputGroup.Checkbox className="big-checkbox"/>
                                    </InputGroup.Prepend>
                                </Col>
                                <Col xs="11">
                                    <p className="text-right">אני מאשר/ת את קריאת התקנון ומסירת הפרטים למאגר הצרכנים
                                        של פארמלוג'ק, בהתאם למדיניות הפרטיות לקבלת הטבות, מבצעים ועדכונים מפארמלוג'יק
                                        ו/או מחברות הקשורות עימה עסקית, בכל אחד מערוצי התקשורת.</p>
                                </Col>
                            </Row>
                        </InputGroup>
                    </div>
                    <div className="mb-3">
                        <Button variant='none' type='submit' className="submitBtn">
                            <CardImg src={btnSubmitUrl}/>
                        </Button>
                    </div>
                </Form>
            </div>
        )
    }
}

export default ContactForm
