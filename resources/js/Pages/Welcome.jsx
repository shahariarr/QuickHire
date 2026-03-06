import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';

const CATEGORIES = [
    { name: 'Technology',   icon: '💻', bg: '#EEF0FD', color: '#4640DE' },
    { name: 'Design',       icon: '🎨', bg: '#E9FAF7', color: '#56CDAD' },
    { name: 'Marketing',    icon: '📢', bg: '#FFF8EE', color: '#FFB836' },
    { name: 'Finance',      icon: '💰', bg: '#E8F4FD', color: '#26A4FF' },
    { name: 'Healthcare',   icon: '🏥', bg: '#FFEEF5', color: '#FF82AD' },
    { name: 'Education',    icon: '📚', bg: '#EEF0FD', color: '#4640DE' },
    { name: 'Engineering',  icon: '⚙️', bg: '#E9FAF7', color: '#56CDAD' },
    { name: 'Sales',        icon: '📈', bg: '#FFF8EE', color: '#FFB836' },
];

export default function Welcome({ latestJobs, totalJobs, totalApplications }) {
    return (
        <AppLayout>
            <Head title="Find Your Perfect Job" />

            {/* ── Hero ─────────────────────────────────────────── */}
            <section style={{ background: '#F8F8FD' }}>
                <div className="container" style={{ paddingTop: 'clamp(2.5rem,7vw,5rem)', paddingBottom: 'clamp(2.5rem,7vw,5rem)' }}>
                    <div style={{ maxWidth: '42rem' }}>
                        <p style={{ fontSize: '.875rem', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '.1em', color: '#4640DE', marginBottom: '1rem' }}>
                            — No. 1 Job Hunting Site
                        </p>
                        <h1 style={{ fontFamily: "'Clash Display',sans-serif", fontSize: 'clamp(2.5rem,6vw,4rem)', fontWeight: 700, lineHeight: 1.1, color: '#25324B', marginBottom: '1.5rem' }}>
                            Discover<br /><span style={{ color: '#4640DE' }}>More Than<br />5000+ Jobs</span>
                        </h1>
                        <p style={{ fontSize: '1rem', lineHeight: 1.75, color: '#515B6F', marginBottom: '2.5rem', maxWidth: '36rem' }}>
                            Great platform for job seekers who are searching for new career heights and passionate about their profession.
                        </p>

                        {/* Search */}
                        <form action="/jobs" method="GET">
                            <div style={{ display: 'flex', flexWrap: 'wrap', background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', overflow: 'hidden', boxShadow: '0 1px 4px rgba(0,0,0,.06)', maxWidth: '48rem' }}>
                                {/* Job title / keyword */}
                                <div className="search-kw" style={{ display: 'flex', alignItems: 'center', gap: '0.75rem', flex: 2, minWidth: '180px', padding: '0.875rem 1rem', borderRight: '1px solid #D6DDEB' }}>
                                    <svg width="18" height="18" fill="none" stroke="#515B6F" strokeWidth="2" viewBox="0 0 24 24" style={{ flexShrink: 0 }}>
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <input name="search" type="text" placeholder="Job title or keyword"
                                        style={{ flex: 1, border: 'none', outline: 'none', fontSize: '.9375rem', color: '#25324B', background: 'transparent', minWidth: 0 }} />
                                </div>
                                {/* Location */}
                                <div className="search-loc" style={{ display: 'flex', alignItems: 'center', gap: '0.75rem', flex: 1, minWidth: '140px', padding: '0.875rem 1rem', borderRight: '1px solid #D6DDEB' }}>
                                    <svg width="18" height="18" fill="none" stroke="#515B6F" strokeWidth="2" viewBox="0 0 24 24" style={{ flexShrink: 0 }}>
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <input name="location" type="text" placeholder="City or remote"
                                        style={{ flex: 1, border: 'none', outline: 'none', fontSize: '.9375rem', color: '#25324B', background: 'transparent', minWidth: 0 }} />
                                </div>
                                <div className="search-btn" style={{ padding: '0.5rem', display: 'flex', alignItems: 'center' }}>
                                    <button type="submit" className="primary-btn">Search</button>
                                </div>
                            </div>
                        </form>

                        {/* Popular tags */}
                        <p style={{ marginTop: '1rem', fontSize: '.875rem', color: '#515B6F' }}>
                            Popular:{' '}
                            {['Technology', 'Design', 'Marketing', 'Finance'].map((c, i) => (
                                <span key={c}>
                                    <Link href={`/jobs?category=${c}`} style={{ color: '#25324B', fontWeight: 500, textDecoration: 'none' }}>{c}</Link>
                                    {i < 3 && <span style={{ color: '#D6DDEB', margin: '0 .25rem' }}>•</span>}
                                </span>
                            ))}
                        </p>
                    </div>
                </div>
            </section>

            {/* ── Stats strip ──────────────────────────────────── */}
            <div style={{ background: '#fff', borderTop: '1px solid #D6DDEB', borderBottom: '1px solid #D6DDEB' }}>
                <div className="container" style={{ padding: '1.5rem 0', display: 'grid', gridTemplateColumns: 'repeat(auto-fit,minmax(160px,1fr))', gap: '1.5rem', textAlign: 'center' }}>
                    {[
                        { value: `${totalJobs}+`, label: 'Live Jobs' },
                        { value: `${totalApplications}+`, label: 'Applications' },
                        { value: '10+', label: 'Categories' },
                        { value: '100%', label: 'Free to Apply' },
                    ].map(s => (
                        <div key={s.label}>
                            <p style={{ fontFamily: "'Clash Display',sans-serif", fontSize: '1.875rem', fontWeight: 700, color: '#25324B' }}>{s.value}</p>
                            <p style={{ fontSize: '.875rem', color: '#7C8493', marginTop: '.25rem' }}>{s.label}</p>
                        </div>
                    ))}
                </div>
            </div>

            {/* ── Categories ────────────────────────────────────── */}
            <section style={{ background: '#F8F8FD', padding: 'clamp(3rem,6vw,5rem) 0' }}>
                <div className="container">
                    <div style={{ textAlign: 'center', marginBottom: '3rem' }}>
                        <h2 style={{ fontFamily: "'Clash Display',sans-serif", fontSize: 'clamp(1.5rem,4vw,2rem)', fontWeight: 700, color: '#25324B', marginBottom: '.5rem' }}>Explore by Category</h2>
                        <p style={{ color: '#515B6F' }}>Find jobs in the field that excites you</p>
                    </div>
                    <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fill,minmax(180px,1fr))', gap: '1rem' }}>
                        {CATEGORIES.map(cat => (
                            <Link key={cat.name} href={`/jobs?category=${cat.name}`}
                                style={{ display: 'block', background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', padding: '1.5rem 1.25rem', textDecoration: 'none', transition: 'border-color .2s' }}
                                onMouseEnter={e => e.currentTarget.style.borderColor = '#4640DE'}
                                onMouseLeave={e => e.currentTarget.style.borderColor = '#D6DDEB'}>
                                <div style={{ width: '3rem', height: '3rem', borderRadius: '0.5rem', background: cat.bg, display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '1.5rem', marginBottom: '0.875rem' }}>
                                    {cat.icon}
                                </div>
                                <p style={{ fontWeight: 600, color: '#25324B' }}>{cat.name}</p>
                            </Link>
                        ))}
                    </div>
                </div>
            </section>

            {/* ── Latest Jobs ───────────────────────────────────── */}
            <section style={{ padding: 'clamp(3rem,6vw,5rem) 0' }}>
                <div className="container">
                    <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', marginBottom: '2rem', flexWrap: 'wrap', gap: '1rem' }}>
                        <h2 style={{ fontFamily: "'Clash Display',sans-serif", fontSize: 'clamp(1.5rem,4vw,2rem)', fontWeight: 700, color: '#25324B' }}>Latest Jobs</h2>
                        <Link href="/jobs" style={{ fontSize: '.875rem', fontWeight: 600, color: '#4640DE', textDecoration: 'none' }}>View all jobs →</Link>
                    </div>
                    <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fill,minmax(min(100%,320px),1fr))', gap: '1rem' }}>
                        {latestJobs.map(job => (
                            <Link key={job.id} href={`/jobs/${job.id}`}
                                style={{ display: 'flex', alignItems: 'center', gap: '1rem', background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', padding: '1.25rem', textDecoration: 'none', transition: 'border-color .2s, box-shadow .2s' }}
                                onMouseEnter={e => { e.currentTarget.style.borderColor='#4640DE'; e.currentTarget.style.boxShadow='0 4px 16px rgba(70,64,222,.08)'; }}
                                onMouseLeave={e => { e.currentTarget.style.borderColor='#D6DDEB'; e.currentTarget.style.boxShadow='none'; }}>
                                <div style={{ width: '3rem', height: '3rem', borderRadius: '0.5rem', background: '#EEF0FD', display: 'flex', alignItems: 'center', justifyContent: 'center', fontWeight: 700, color: '#4640DE', fontSize: '.875rem', flexShrink: 0 }}>
                                    {(job.company || '').slice(0, 2).toUpperCase()}
                                </div>
                                <div style={{ minWidth: 0 }}>
                                    <p style={{ fontWeight: 600, color: '#25324B', fontSize: '.9375rem', whiteSpace: 'nowrap', overflow: 'hidden', textOverflow: 'ellipsis' }}>{job.title}</p>
                                    <p style={{ fontSize: '.8125rem', color: '#7C8493', marginTop: '.125rem' }}>{job.company} · {job.location}</p>
                                    <div style={{ display: 'flex', gap: '.5rem', marginTop: '.5rem', flexWrap: 'wrap' }}>
                                        {job.type && <span style={{ fontSize: '.7rem', fontWeight: 600, padding: '2px 8px', borderRadius: '3px', border: '1px solid #56CDAD', color: '#56CDAD', background: '#E9FAF7' }}>{job.type}</span>}
                                        <span style={{ fontSize: '.7rem', fontWeight: 600, padding: '2px 8px', borderRadius: '3px', border: '1px solid #FFB836', color: '#FFB836', background: '#FFF8EE' }}>{job.category}</span>
                                    </div>
                                </div>
                            </Link>
                        ))}
                    </div>
                </div>
            </section>

            {/* ── How it works ─────────────────────────────────── */}
            <section id="how-it-works" style={{ background: '#F8F8FD', padding: 'clamp(3rem,6vw,5rem) 0' }}>
                <div className="container">
                    <div style={{ textAlign: 'center', marginBottom: '3rem' }}>
                        <h2 style={{ fontFamily: "'Clash Display',sans-serif", fontSize: 'clamp(1.5rem,4vw,2rem)', fontWeight: 700, color: '#25324B', marginBottom: '.5rem' }}>How It Works</h2>
                        <p style={{ color: '#515B6F' }}>Simple steps to find your dream job</p>
                    </div>
                    <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit,minmax(220px,1fr))', gap: '2rem' }}>
                        {[
                            { step: '01', title: 'Browse Jobs', desc: 'Search thousands of open positions across multiple categories.' },
                            { step: '02', title: 'Apply Online', desc: 'Submit your application with a resume link and cover note.' },
                            { step: '03', title: 'Get Hired',    desc: 'Employers review applications and reach out to the best candidates.' },
                        ].map(s => (
                            <div key={s.step} style={{ background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', padding: '2rem 1.5rem' }}>
                                <p style={{ fontFamily: "'Clash Display',sans-serif", fontSize: '3.5rem', fontWeight: 700, color: '#D6DDEB', lineHeight: 1, marginBottom: '1rem' }}>{s.step}</p>
                                <div style={{ width: '2.5rem', height: '2.5rem', background: '#EEF0FD', borderRadius: '50%', display: 'flex', alignItems: 'center', justifyContent: 'center', marginBottom: '0.875rem' }}>
                                    <svg width="16" height="16" fill="none" stroke="#4640DE" strokeWidth="2" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <h3 style={{ fontWeight: 700, color: '#25324B', marginBottom: '.5rem' }}>{s.title}</h3>
                                <p style={{ fontSize: '.875rem', color: '#515B6F', lineHeight: 1.6 }}>{s.desc}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* ── CTA ───────────────────────────────────────────── */}
            <section style={{ background: '#4640DE', padding: 'clamp(3rem,6vw,5rem) 0' }}>
                <div className="container" style={{ textAlign: 'center' }}>
                    <h2 style={{ fontFamily: "'Clash Display',sans-serif", fontSize: 'clamp(1.5rem,4vw,2rem)', fontWeight: 700, color: '#fff', marginBottom: '1rem' }}>Start Your Job Search Today</h2>
                    <p style={{ color: 'rgba(255,255,255,.8)', marginBottom: '2rem' }}>Thousands of companies are hiring right now</p>
                    <Link href="/jobs" style={{ background: '#fff', color: '#4640DE', fontWeight: 700, padding: '12px 32px', borderRadius: '0.375rem', textDecoration: 'none', fontSize: '1rem' }}>
                        Browse All Jobs
                    </Link>
                </div>
            </section>
        </AppLayout>
    );
}
