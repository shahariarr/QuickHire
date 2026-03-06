import React, { useState, useEffect } from 'react';

const CATEGORIES = [
    'Technology', 'Design', 'Marketing', 'Finance',
    'Healthcare', 'Education', 'Engineering', 'Sales', 'Legal', 'Remote',
];

/* ── debounce hook ─────────────────────────────────────────── */
function useDebounce(value, delay) {
    const [debounced, setDebounced] = useState(value);
    useEffect(() => {
        const t = setTimeout(() => setDebounced(value), delay);
        return () => clearTimeout(t);
    }, [value, delay]);
    return debounced;
}

/* ── spinner ───────────────────────────────────────────────── */
function Spinner() {
    return (
        <div style={{ display: 'flex', justifyContent: 'center', alignItems: 'center', padding: '5rem 0' }}>
            <div style={{
                width: '2.5rem', height: '2.5rem',
                border: '3px solid #EEF0FD',
                borderTopColor: '#4640DE',
                borderRadius: '50%',
                animation: 'qh-spin 0.65s linear infinite',
            }} />
        </div>
    );
}

/* ── single job card ───────────────────────────────────────── */
function JobCard({ job }) {
    const initials = (job.company || '').slice(0, 2).toUpperCase() || '##';

    const cardStyle = {
        display: 'flex', alignItems: 'center', gap: '1.25rem',
        background: '#fff', border: '1px solid #D6DDEB',
        borderRadius: '0.5rem', padding: '1.25rem',
        textDecoration: 'none', transition: 'border-color .2s, box-shadow .2s',
        cursor: 'pointer',
    };

    return (
        <a
            href={`/jobs/${job.id}`}
            style={cardStyle}
            onMouseEnter={e => {
                e.currentTarget.style.borderColor = '#4640DE';
                e.currentTarget.style.boxShadow = '0 4px 16px rgba(70,64,222,.1)';
            }}
            onMouseLeave={e => {
                e.currentTarget.style.borderColor = '#D6DDEB';
                e.currentTarget.style.boxShadow = 'none';
            }}
        >
            {/* avatar */}
            <div style={{
                width: '3.5rem', height: '3.5rem', borderRadius: '0.5rem',
                border: '1px solid #D6DDEB', display: 'flex', alignItems: 'center',
                justifyContent: 'center', fontWeight: 700, fontSize: '1rem',
                color: '#4640DE', background: '#EEF0FD', flexShrink: 0,
            }}>
                {initials}
            </div>

            {/* info */}
            <div style={{ flex: 1, minWidth: 0 }}>
                <div style={{ display: 'flex', alignItems: 'flex-start', justifyContent: 'space-between', gap: '1rem' }}>
                    <div>
                        <h2 style={{ fontWeight: 600, fontSize: '1rem', color: '#25324B', margin: 0 }}>{job.title}</h2>
                        <p style={{ fontSize: '.875rem', color: '#515B6F', margin: '0.125rem 0 0' }}>{job.company}</p>
                    </div>
                    {job.type && (
                        <span style={{
                            fontSize: '.75rem', fontWeight: 500,
                            padding: '0.25rem 0.75rem',
                            border: '1px solid #56CDAD', borderRadius: '0.25rem',
                            color: '#56CDAD', background: '#E9FAF7',
                            whiteSpace: 'nowrap', flexShrink: 0,
                        }}>{job.type}</span>
                    )}
                </div>

                <div style={{ display: 'flex', flexWrap: 'wrap', alignItems: 'center', gap: '0.75rem', marginTop: '0.75rem' }}>
                    {job.location && (
                        <span style={{ fontSize: '.75rem', color: '#7C8493', display: 'flex', alignItems: 'center', gap: '0.25rem' }}>
                            <svg width="14" height="14" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                            {job.location}
                        </span>
                    )}
                    <span style={{ color: '#D6DDEB' }}>•</span>
                    <span style={{
                        fontSize: '.75rem', padding: '0.125rem 0.5rem',
                        border: '1px solid #FFB836', borderRadius: '0.25rem',
                        fontWeight: 500, color: '#FFB836', background: '#FFF8EE',
                    }}>{job.category}</span>
                    {(job.applications_count ?? 0) > 0 && (
                        <>
                            <span style={{ color: '#D6DDEB' }}>•</span>
                            <span style={{ fontSize: '.75rem', color: '#7C8493' }}>
                                {job.applications_count} applicant{job.applications_count !== 1 ? 's' : ''}
                            </span>
                        </>
                    )}
                </div>
            </div>

            {/* arrow */}
            <svg width="20" height="20" fill="none" stroke="#4640DE" strokeWidth="2" viewBox="0 0 24 24"
                style={{ flexShrink: 0, opacity: 0.3 }}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    );
}

/* ── main component ────────────────────────────────────────── */
export default function JobSearch({ initialJobs = [], totalCount = 0 }) {
    const [search, setSearch]     = useState('');
    const [location, setLocation] = useState('');
    const [category, setCategory] = useState('');
    const [jobs, setJobs]         = useState(initialJobs);
    const [total, setTotal]       = useState(totalCount);
    const [loading, setLoading]   = useState(false);
    const [error, setError]       = useState(null);
    const [touched, setTouched]   = useState(false);   // avoid fetch on mount

    const dSearch   = useDebounce(search, 350);
    const dLocation = useDebounce(location, 350);

    useEffect(() => {
        if (!touched) { setTouched(true); return; }   // skip first render

        const params = new URLSearchParams();
        if (dSearch)   params.set('search',   dSearch);
        if (dLocation) params.set('location', dLocation);
        if (category)  params.set('category', category);

        setLoading(true);
        setError(null);

        fetch(`/api/jobs?${params.toString()}`, {
            headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
        })
            .then(r => { if (!r.ok) throw new Error('API error'); return r.json(); })
            .then(json => {
                setJobs(json.data || []);
                setTotal(json.total ?? json.data?.length ?? 0);
            })
            .catch(() => setError('Could not load jobs. Please try again.'))
            .finally(() => setLoading(false));
    // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [dSearch, dLocation, category]);

    const hasFilter = search || location || category;
    const clearAll  = () => { setSearch(''); setLocation(''); setCategory(''); };

    /* shared input container style */
    const inputBox = (extra = {}) => ({
        display: 'flex', alignItems: 'center', gap: '0.75rem',
        padding: '0.75rem 1rem', borderRight: '1px solid #D6DDEB',
        ...extra,
    });

    return (
        <>
            {/* keyframe injected once */}
            <style>{`@keyframes qh-spin{to{transform:rotate(360deg)}}`}</style>

            {/* ── Filter bar ── */}
            <div style={{ background: '#fff', borderBottom: '1px solid #D6DDEB' }}>
                <div className="container" style={{ paddingTop: '2.5rem', paddingBottom: '2.5rem' }}>
                    <h1 style={{
                        fontFamily: "'Clash Display',sans-serif", color: '#25324B',
                        fontSize: '1.875rem', fontWeight: 700, margin: '0 0 0.25rem',
                    }}>Browse Jobs</h1>
                    <p style={{ color: '#515B6F', fontSize: '.875rem', margin: '0 0 1.5rem' }}>
                        {loading ? 'Searching…' : `${total} job${total !== 1 ? 's' : ''} found`}
                    </p>

                    {/* search bar */}
                    <div style={{
                        display: 'flex', flexWrap: 'wrap',
                        background: '#fff', border: '1px solid #D6DDEB',
                        borderRadius: '0.5rem', overflow: 'hidden',
                        boxShadow: '0 1px 4px rgba(0,0,0,.06)', maxWidth: '48rem',
                    }}>
                        {/* keyword */}
                        <div style={inputBox({ flex: 1 })}>
                            <svg width="16" height="16" fill="none" stroke="#515B6F" strokeWidth="2" viewBox="0 0 24 24" style={{ flexShrink: 0 }}>
                                <path strokeLinecap="round" strokeLinejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input
                                type="text" value={search}
                                onChange={e => setSearch(e.target.value)}
                                placeholder="Job title or company"
                                style={{ flex: 1, border: 'none', outline: 'none', fontSize: '.875rem', color: '#25324B', background: 'transparent' }}
                            />
                        </div>

                        {/* location */}
                        <div style={inputBox({ width: '11rem', flexShrink: 0 })}>
                            <svg width="16" height="16" fill="none" stroke="#515B6F" strokeWidth="2" viewBox="0 0 24 24" style={{ flexShrink: 0 }}>
                                <path strokeLinecap="round" strokeLinejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                            <input
                                type="text" value={location}
                                onChange={e => setLocation(e.target.value)}
                                placeholder="Location"
                                style={{ flex: 1, border: 'none', outline: 'none', fontSize: '.875rem', color: '#25324B', background: 'transparent', minWidth: 0 }}
                            />
                        </div>

                        {/* category */}
                        <div style={{ padding: '0.5rem 0.75rem', width: '11.5rem', flexShrink: 0, borderRight: '1px solid #D6DDEB', display: 'flex', alignItems: 'center' }}>
                            <select
                                value={category}
                                onChange={e => setCategory(e.target.value)}
                                style={{ width: '100%', border: 'none', outline: 'none', fontSize: '.875rem', color: '#515B6F', background: 'transparent' }}
                            >
                                <option value="">All Categories</option>
                                {CATEGORIES.map(c => <option key={c} value={c}>{c}</option>)}
                            </select>
                        </div>

                        {/* clear */}
                        <div style={{ display: 'flex', alignItems: 'center', padding: '0.5rem 0.75rem' }}>
                            {hasFilter && (
                                <button onClick={clearAll} style={{
                                    background: 'none', border: '1px solid #D6DDEB', borderRadius: '0.375rem',
                                    padding: '0.375rem 0.75rem', fontSize: '.75rem', color: '#515B6F', cursor: 'pointer',
                                }}>Clear</button>
                            )}
                        </div>
                    </div>
                </div>
            </div>

            {/* ── Results ── */}
            <div style={{ background: '#F8F8FD', minHeight: '60vh' }}>
                <div className="container" style={{ paddingTop: '2.5rem', paddingBottom: '2.5rem' }}>
                    {loading ? (
                        <Spinner />
                    ) : error ? (
                        <div style={{ textAlign: 'center', padding: '5rem 0', color: '#515B6F' }}>{error}</div>
                    ) : jobs.length === 0 ? (
                        <div style={{
                            textAlign: 'center', padding: '6rem 1rem',
                            background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem',
                        }}>
                            <svg width="64" height="64" fill="none" stroke="#D6DDEB" strokeWidth="1.5" viewBox="0 0 24 24"
                                style={{ margin: '0 auto 1rem', display: 'block' }}>
                                <path strokeLinecap="round" strokeLinejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <p style={{ fontWeight: 600, color: '#25324B', margin: '0 0 0.5rem' }}>No jobs found</p>
                            <p style={{ fontSize: '.875rem', color: '#515B6F', margin: 0 }}>Try adjusting your filters or check back later.</p>
                            {hasFilter && (
                                <button onClick={clearAll} style={{
                                    marginTop: '1rem', background: 'none', border: 'none',
                                    color: '#4640DE', fontWeight: 600, cursor: 'pointer', fontSize: '.875rem',
                                }}>Clear filters →</button>
                            )}
                        </div>
                    ) : (
                        <div style={{ display: 'flex', flexDirection: 'column', gap: '1rem' }}>
                            {jobs.map(job => <JobCard key={job.id} job={job} />)}
                        </div>
                    )}
                </div>
            </div>
        </>
    );
}
