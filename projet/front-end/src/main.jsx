import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import BookingForm from './compenents/bookingform.jsx'
import Hero from './compenents/home/hero.jsx'

createRoot(document.getElementById('root')).render(
  <StrictMode>
    {/* <BookingForm /> */}
    <Hero/>
  </StrictMode>,
)
