import React, { useState, useCallback, useEffect } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';

function debounce(fn, delay) {
    let t;
    return (...args) => { clearTimeout(t); t = setTimeout(() => fn(...args), delay); };
}

function JobCard({ job }) {
    return (
        <Link href={`/jobs/${job.id}`}
            style={{ display: 'flex', flexWrap: 'wrap', gap: '1rem', background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', padding: '1.5rem', textDecoration: 'none', transition: 'border-color .2s, box-shadow .2s' }}
            onMouseEnter={e => { e.currentTarget.style.borderColor='#4640DE'; e.currentTarget.style.boxShadow='0 4px 16px rgba(70,64,222,.08)'; }}
            onMouseLeave={e => { e.currentTarget.style.borderColor='#D6DDEB'; e.currentTarget.style.boxShadow='none'; }}>
            <div style={{ width: '3rem', height: '3rem', borderRadius: '0.5rem', background: '#EEF0FD', display: 'flex', alignItems: 'center', justifyContent: 'center', fontWeight: 700, color: '#4640DE', flexShrink: 0 }}>
                {(job.company || '').slice(0, 2).toUpperCase()}
            </div>
            <div style={{ flex: 1, minWidth: 0 }}>
                <p style={{ fontWeight: 700, color: '#25324B', fontSize: '1rem' }}>{job.title}</p>
                <p style={{ fontSize: '.875rem', color: '#7C8493', marginTop: '.25rem' }}>{job.company} · {job.location}</p>
                <div style={{ display: 'flex', gap: '.5rem', marginTop: '.75rem', flexWrap: 'wrap' }}>
                    {job.type && <span style={{ fontSize: '.75rem', fontWeight: 600, padding: '3px 10px', borderRadius: '3px', border: '1px solid #56CDAD', color: '#56CDAD', background: '#E9FAF7' }}>{job.type}</span>}
                    {job.category && <span style={{ fontSize: '.75rem', fontWeight: 600, padding: '3px 10px', borderRadius: '3px', border: '1px solid #FFB836', color: '#FFB836', background: '#FFF8EE' }}>{job.category}</span>}
                </div>
            </div>
            <div style={{ display: 'flex', alignItems: 'center' }}>
                <span style={{ fontSize: '.8125rem', color: '#7C8493' }}>
                    {new Date(job.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric' })}
                </span>
            </div>
        </Link>
    );
}

function Pagination({ links }) {
    return (
        <div style={{ display: 'flex', justifyContent: 'center', gap: '.5rem', marginTop: '2.5rem', flexWrap: 'wrap' }}>
            {links.map((link, i) => {
                if (!link.url) {
                    return (
                        <span key={i} dangerouslySetInnerHTML={{ __html: link.label }}
                            style={{ padding: '6px 14px', borderRadius: '4px', fontSize: '.875rem', color: '#7C8493', background: 'transparent', cursor: 'default' }} />
                    );
                }
                return (
                    <Link key={i} href={link.url} preserveState
                        dangerouslySetInnerHTML={{ __html: link.label }}
                        style={{ padding: '6px 14px', borderRadius: '4px', fontSize: '.875rem', textDecoration: 'none', border: '1px solid', borderColor: link.active ? '#4640DE' : '#D6DDEB', background: link.active ? '#4640DE' : '#fff', color: link.active ? '#fff' : '#515B6F' }} />
                );
            })}
        </div>
    );
}

const CATEGORIES = ['Technology', 'Design', 'Marketing', 'Finance', 'Healthcare', 'Education', 'Engineering', 'Sales'];
const JOB_TYPES  = ['Full-time', 'Part-time', 'Contract', 'Remote', 'Internship'];

function useIsMobile() {
    const [v, setV] = useState(typeof window !== 'undefined' ? window.innerWidth < 768 : false);
    useEffect(() => {
        const fn = () => setV(window.innerWidth < 768);
        window.addEventListener('resize', fn);
        return () => window.removeEventListener('resize', fn);
    }, []);
    return v;
}

export default function JobsIndex({ jobs, filters }) {
    const [search,   setSearch]   = useState(filters?.search   ?? '');
    const [location, setLocation] = useState(filters?.location ?? '');
    const [category, setCategory] = useState(filters?.category ?? '');
    const [type,     setType]     = useState(filters?.type     ?? '');
    const isMobile = useIsMobile();
    const [filtersOpen, setFiltersOpen] = useState(false);

    const visit = useCallback(debounce((params) => {
        router.visit('/jobs', { data: params, preserveState: true, replace: true });
    }, 350), []);

    const handleSearch   = v => { setSearch(v);   visit({ search: v, location, category, type }); };
    const handleLocation = v => { setLocation(v); visit({ search, location: v, category, type }); };
    const handleCategory = v => { setCategory(v); router.visit('/jobs', { data: { search, location, category: v, type }, preserveState: true, replace: true }); };
    const handleType     = v => { setType(v);     router.visit('/jobs', { data: { search, location, category, type: v }, preserveState: true, replace: true }); };

    const clearFilters = () => {
        setSearch(''); setLocation(''); setCategory(''); setType('');
        router.visit('/jobs', { preserveState: false, replace: true });
    };

    const hasFilters = search || location || category || type;
    const total = jobs?.total ?? 0;

    return (
        <AppLayout>
            <Head title="Browse Jobs" />

            {/* ── Page header ─── */}
            <div style={{ background: '#F8F8FD', borderBottom: '1px solid #D6DDEB', padding: '3rem 0' }}>
                <div className="container">
                    <h1 style={{ fontFamily: "'Clash Display',sans-serif", fontSize: '2rem', fontWeight: 700, color: '#25324B', marginBottom: '.5rem' }}>
                        Browse Jobs <span style={{ color: '#4640DE' }}>({total})</span>
                    </h1>
                    <p style={{ color: '#515B6F' }}>Find the job that matches your skills and passion.</p>
                </div>
            </div>

            {/* ── Filters + Results ─── */}
            <div className="container" style={{ paddingTop: '2.5rem', paddingBottom: '4rem', display: 'flex', gap: '2rem', flexWrap: 'wrap', alignItems: 'flex-start' }}>

                {/* Mobile filter toggle button */}
                {isMobile && (
                    <div style={{ width: '100%', display: 'flex', alignItems: 'center', justifyContent: 'space-between', gap: '.75rem' }}>
                        <button onClick={() => setFiltersOpen(o => !o)}
                            style={{ display: 'flex', alignItems: 'center', gap: '0.5rem', padding: '9px 16px', background: '#fff', border: '1px solid #D6DDEB', borderRadius: '6px', fontSize: '.875rem', color: '#25324B', cursor: 'pointer', fontFamily: 'inherit', fontWeight: 600 }}>
                            <svg width="15" height="15" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
                            </svg>
                            {filtersOpen ? 'Hide Filters' : 'Show Filters'}
                            {hasFilters && <span style={{ background: '#4640DE', color: '#fff', borderRadius: '50%', width: '16px', height: '16px', display: 'inline-flex', alignItems: 'center', justifyContent: 'center', fontSize: '.625rem', fontWeight: 700, marginLeft: '.125rem' }}>✓</span>}
                        </button>
                        <p style={{ fontSize: '.8125rem', color: '#7C8493' }}>{total} jobs</p>
                    </div>
                )}

                {/* Sidebar filters */}
                {(!isMobile || filtersOpen) && (
                <aside style={{ width: isMobile ? '100%' : '240px', flexShrink: 0 }}>
                    {/* Search */}
                    <div style={{ marginBottom: '1.5rem' }}>
                        <label style={{ fontSize: '.8125rem', fontWeight: 600, color: '#25324B', display: 'block', marginBottom: '.5rem' }}>Search</label>
                        <input value={search} onChange={e => handleSearch(e.target.value)}
                            placeholder="Job title, company..."
                            style={{ width: '100%', padding: '8px 12px', border: '1px solid #D6DDEB', borderRadius: '4px', fontSize: '.875rem', color: '#25324B', outline: 'none', boxSizing: 'border-box' }} />
                    </div>

                    {/* Location */}
                    <div style={{ marginBottom: '1.5rem' }}>
                        <label style={{ fontSize: '.8125rem', fontWeight: 600, color: '#25324B', display: 'block', marginBottom: '.5rem' }}>Location</label>
                        <input value={location} onChange={e => handleLocation(e.target.value)}
                            placeholder="City, remote..."
                            style={{ width: '100%', padding: '8px 12px', border: '1px solid #D6DDEB', borderRadius: '4px', fontSize: '.875rem', color: '#25324B', outline: 'none', boxSizing: 'border-box' }} />
                    </div>

                    {/* Category */}
                    <div style={{ marginBottom: '1.5rem' }}>
                        <label style={{ fontSize: '.8125rem', fontWeight: 600, color: '#25324B', display: 'block', marginBottom: '.5rem' }}>Category</label>
                        <select value={category} onChange={e => handleCategory(e.target.value)}
                            style={{ width: '100%', padding: '8px 12px', border: '1px solid #D6DDEB', borderRadius: '4px', fontSize: '.875rem', color: '#25324B', outline: 'none', background: '#fff', boxSizing: 'border-box' }}>
                            <option value="">All Categories</option>
                            {CATEGORIES.map(c => <option key={c} value={c}>{c}</option>)}
                        </select>
                    </div>

                    {/* Type */}
                    <div style={{ marginBottom: '1.5rem' }}>
                        <label style={{ fontSize: '.8125rem', fontWeight: 600, color: '#25324B', display: 'block', marginBottom: '.5rem' }}>Job Type</label>
                        <select value={type} onChange={e => handleType(e.target.value)}
                            style={{ width: '100%', padding: '8px 12px', border: '1px solid #D6DDEB', borderRadius: '4px', fontSize: '.875rem', color: '#25324B', outline: 'none', background: '#fff', boxSizing: 'border-box' }}>
                            <option value="">All Types</option>
                            {JOB_TYPES.map(t => <option key={t} value={t}>{t}</option>)}
                        </select>
                    </div>

                    {hasFilters && (
                        <button onClick={clearFilters}
                            style={{ width: '100%', padding: '8px', border: '1px solid #D6DDEB', borderRadius: '4px', background: '#fff', fontSize: '.8125rem', color: '#515B6F', cursor: 'pointer' }}>
                            Clear all filters
                        </button>
                    )}
                </aside>
                )}

                {/* Results */}
                <div style={{ flex: 1, minWidth: 0 }}>
                    {jobs?.data?.length === 0 ? (
                        <div style={{ textAlign: 'center', padding: '4rem', background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem' }}>
                            <p style={{ fontFamily: "'Clash Display',sans-serif", fontSize: '1.5rem', fontWeight: 700, color: '#25324B', marginBottom: '.5rem' }}>No jobs found</p>
                            <p style={{ color: '#515B6F' }}>Try adjusting your search filters.</p>
                        </div>
                    ) : (
                        <>
                            <p style={{ fontSize: '.875rem', color: '#7C8493', marginBottom: '1rem' }}>
                                Showing <strong style={{ color: '#25324B' }}>{jobs?.from}–{jobs?.to}</strong> of <strong style={{ color: '#25324B' }}>{total}</strong> jobs
                            </p>
                            <div style={{ display: 'flex', flexDirection: 'column', gap: '.75rem' }}>
                                {jobs?.data?.map(job => <JobCard key={job.id} job={job} />)}
                            </div>
                            {jobs?.links && <Pagination links={jobs.links} />}
                        </>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}
