import './bootstrap';
import { createRoot } from 'react-dom/client';
import App from './components/App';

// Mount React app if root element exists
const rootElement = document.getElementById('react-root');
if (rootElement) {
    const root = createRoot(rootElement);
    root.render(<App />);
}
