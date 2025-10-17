import Header from './Header';
import Footer from './Footer';

const Layout = ({ children }) => (
  <div className="bg-[#F7FAFF] font-sans text-slate-800 min-h-screen flex flex-col">
    <Header />
    <div className="flex-1">
      {children}
    </div>
    <Footer />
  </div>
);

export default Layout;
