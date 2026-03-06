import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';
import JobSearch from './components/JobSearch';

const jobSearchEl = document.getElementById('job-search-root');
if (jobSearchEl) {
    const initialJobs = JSON.parse(jobSearchEl.dataset.jobs || '[]');
    const totalCount  = parseInt(jobSearchEl.dataset.total || '0', 10);
    createRoot(jobSearchEl).render(
        React.createElement(JobSearch, { initialJobs, totalCount })
    );
}
