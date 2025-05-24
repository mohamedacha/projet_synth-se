import { Link } from "react-router-dom";
import './homepage.css';
const Hero = () => {
  return (
    <div className="relative bg-gradient-to-b from-carwash-800 to-carwash-600 text-white overflow-hidden">
      {/* Background water bubbles */}
      <div className="absolute inset-0 overflow-hidden">
        {Array.from({ length: 15 }).map((_, i) => (
          <div
            key={i}
            className="absolute rounded-full bg-white/10 animate-bubble"
            style={{
              width: `${Math.random() * 100 + 50}px`,
              height: `${Math.random() * 100 + 50}px`,
              top: `${Math.random() * 100}%`,
              left: `${Math.random() * 100}%`,
              animationDuration: `${Math.random() * 8 + 4}s`,
              animationDelay: `${Math.random() * 5}s`,
            }}
          />
        ))}
      </div>

      <div className="relative min-h-[90vh] flex items-center">
        <div className="container mx-auto px-4 md:px-6 py-24 md:py-32">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div className="space-y-8">
              <h1 className="text-4xl md:text-6xl font-bold leading-tight">
                <span className="block">Professional</span>
                <span className="block">Car Wash Service</span>
              </h1>
              <p className="text-xl md:text-2xl text-blue-50 font-light max-w-md">
                Premium car washing and detailing services that leave your vehicle looking brand new.
              </p>
              <div className="flex flex-col sm:flex-row gap-4">
                {/* <Link
                  to="/booking"
                  className="inline-block px-8 py-4 text-carwash-700 bg-white font-semibold rounded-lg hover:bg-blue-50 text-lg text-center"
                >
                  Book Now
                </Link>
                <Link
                  to="/services"
                  className="inline-block px-8 py-4 border border-white text-white rounded-lg hover:bg-white/10 text-lg text-center"
                >
                  Our Services
                </Link> */}
              </div>
              <div className="grid grid-cols-3 gap-4 pt-4">
                <div className="text-center">
                  <h3 className="text-3xl font-bold">10+</h3>
                  <p className="text-blue-100">Years Experience</p>
                </div>
                <div className="text-center">
                  <h3 className="text-3xl font-bold">5000+</h3>
                  <p className="text-blue-100">Happy Customers</p>
                </div>
                <div className="text-center">
                  <h3 className="text-3xl font-bold">100%</h3>
                  <p className="text-blue-100">Satisfaction</p>
                </div>
              </div>
            </div>
            <div className="hidden md:block relative">
              <div className="absolute -top-6 -right-6 w-72 h-72 bg-gradient-to-br from-carwash-400 to-blue-500 rounded-full blur-3xl opacity-30"></div>
              <img
                src="https://images.unsplash.com/photo-1520340356584-f9917d1eea6f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80"
                alt="Clean car being washed"
                className="rounded-lg shadow-2xl relative z-10 max-w-md mx-auto"
              />
            </div>
          </div>
        </div>

        <div className="absolute bottom-0 left-0 right-0">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" className="w-full">
            <path
              fill="#f8fafc"
              fillOpacity="1"
              d="M0,192L48,202.7C96,213,192,235,288,224C384,213,480,171,576,154.7C672,139,768,149,864,170.7C960,192,1056,224,1152,213.3C1248,203,1344,149,1392,122.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
            ></path>
          </svg>
        </div>
      </div>
    </div>
  );
};

export default Hero;
