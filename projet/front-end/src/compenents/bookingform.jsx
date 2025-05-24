import React, { useState } from "react";

const SERVICES = [
  { id: "basic", name: "Basic Wash", price: 19.99 },
  { id: "premium", name: "Premium Wash", price: 39.99 },
  { id: "deluxe", name: "Deluxe Detail", price: 79.99 },
];

const TIME_SLOTS = [
  "9:00 AM", "10:00 AM", "11:00 AM", "12:00 PM",
  "1:00 PM", "2:00 PM", "3:00 PM", "4:00 PM", "5:00 PM"
];

const BookingForm = () => {
  const [date, setDate] = useState<string>("");
  const [timeSlot, setTimeSlot] = useState<string>("");
  const [selectedService, setSelectedService] = useState<string>("");
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    phone: "",
    carModel: "",
    notes: "",
  });

  const handleInputChange = () => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  const getServicePrice = () => {
    const service = SERVICES.find(s => s.id === selectedService);
    return service ? service.price : 0;
  };

  const handleSubmit = () => {
    e.preventDefault();

    if (!date || !timeSlot || !selectedService || !formData.name || !formData.email || !formData.phone || !formData.carModel) {
      alert("Please fill in all required fields.");
      return;
    }

    alert(`Booking confirmed for ${formData.name} on ${date} at ${timeSlot} for ${selectedService}.`);

    setDate("");
    setTimeSlot("");
    setSelectedService("");
    setFormData({
      name: "",
      email: "",
      phone: "",
      carModel: "",
      notes: "",
    });
  };

  return (
    <form onSubmit={handleSubmit} className="booking-form">
      <h2>Service Details</h2>

      <div>
        <label>Choose a service:</label>
        {SERVICES.map(service => (
          <div key={service.id}>
            <input
              type="radio"
              id={service.id}
              name="service"
              value={service.id}
              checked={selectedService === service.id}
              onChange={(e) => setSelectedService(e.target.value)}
            />
            <label htmlFor={service.id}>{service.name} - ${service.price.toFixed(2)}</label>
          </div>
        ))}
      </div>

      <div>
        <label>Select a date:</label>
        <input
          type="date"
          value={date}
          onChange={(e) => setDate(e.target.value)}
        />
      </div>

      <div>
        <label>Select a time:</label>
        <select value={timeSlot} onChange={(e) => setTimeSlot(e.target.value)}>
          <option value="">--Select Time--</option>
          {TIME_SLOTS.map(time => (
            <option key={time} value={time}>{time}</option>
          ))}
        </select>
      </div>

      <h2>Personal Information</h2>

      <div>
        <label>Name:</label>
        <input name="name" value={formData.name} onChange={handleInputChange} required />
      </div>

      <div>
        <label>Email:</label>
        <input name="email" type="email" value={formData.email} onChange={handleInputChange} required />
      </div>

      <div>
        <label>Phone:</label>
        <input name="phone" value={formData.phone} onChange={handleInputChange} required />
      </div>

      <div>
        <label>Car Make & Model:</label>
        <input name="carModel" value={formData.carModel} onChange={handleInputChange} required />
      </div>

      <div>
        <label>Notes:</label>
        <textarea name="notes" value={formData.notes} onChange={handleInputChange} />
      </div>

      <h2>Booking Summary</h2>
      <p>Service: {selectedService ? SERVICES.find(s => s.id === selectedService)?.name : "Not selected"}</p>
      <p>Date & Time: {date || "Not selected"} {timeSlot && `at ${timeSlot}`}</p>
      <p>Total Price: ${getServicePrice().toFixed(2)}</p>

      <button type="submit">Confirm Booking</button>
    </form>
  );
};

export default BookingForm;
