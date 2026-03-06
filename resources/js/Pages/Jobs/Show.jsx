import React, { useState, useEffect } from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';

function useIsMobile() {
    const [v, setV] = useState(typeof window !== 'undefined' ? window.innerWidth < 768 : false);
    useEffect(() => {
        const fn = () => setV(window.innerWidth < 768);
        window.addEventListener('resize', fn);
        return () => window.removeEventListener('resize', fn);
    }, []);
    return v;
}

export default function JobShow({ job, relatedJobs }) {
    const isMobile = useIsMobile();
    const postedDate = job.created_at
        ? new Date(job.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })
        : '';

    return (
        <AppLayout>
            <Head title={`${job.title} at ${job.company}`} />

            {/* ── Breadcrumb / header ─── */}
            <div style={{ background: '#F8F8FD', borderBottom: '1px solid #D6DDEB', padding: '2rem 0' }}>
                <div className="container">
                    <nav style={{ fontSize: '.8125rem', color: '#7C8493', marginBottom: '.75rem' }}>
                        <Link href="/" style={{ color: '#7C8493', textDecoration: 'none' }}>Home</Link>
                        {' / '}
                        <Link href="/jobs" style={{ color: '#7C8493', textDecoration: 'none' }}>Jobs</Link>
                        {' / '}
                        <span style={{ color: '#25324B' }}>{job.title}</span>
                    </nav>
                    <div style={{ display: 'flex', alignItems: 'center', gap: '1rem', flexWrap: 'wrap' }}>
                        <div style={{ width: '4rem', height: '4rem', borderRadius: '0.5rem', background: '#EEF0FD', display: 'flex', alignItems: 'center', justifyContent: 'center', fontWeight: 700, color: '#4640DE', fontSize: '1.25rem', flexShrink: 0 }}>
                            {(job.company || '').slice(0, 2).toUpperCase()}
                        </div>
                        <div>
                            <h1 style={{ fontFamily: "'Clash Display',sans-serif", fontSize: 'clamp(1.25rem,4vw,1.75rem)', fontWeight: 700, color: '#25324B' }}>{job.title}</h1>
                            <p style={{ color: '#515B6F', fontSize: '.9375rem' }}>{job.company} · {job.location}</p>
                        </div>
                    </div>
                </div>
            </div>

            {/* ── Main content ─── */}
            <div className="container job-show-layout" style={{ paddingTop: '2.5rem', paddingBottom: '4rem', display: 'flex', gap: '2rem', flexDirection: isMobile ? 'column' : 'row', alignItems: 'flex-start' }}>

                {/* Description */}
                <div style={{ flex: 1, minWidth: 0 }}>
                    <div style={{ background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', padding: 'clamp(1.25rem,4vw,2rem)' }}>
                        <h2 style={{ fontFamily: "'Clash Display',sans-serif", fontSize: '1.25rem', fontWeight: 700, color: '#25324B', marginBottom: '1.25rem', paddingBottom: '1rem', borderBottom: '1px solid #D6DDEB' }}>
                            Job Description
                        </h2>
                        <div style={{ color: '#515B6F', lineHeight: 1.75, fontSize: '.9375rem', whiteSpace: 'pre-wrap' }}>
                            {job.description}
                        </div>
                    </div>
                </div>

                {/* Sidebar */}
                <aside className="job-show-aside" style={{ width: isMobile ? '100%' : '280px', flexShrink: 0, display: 'flex', flexDirection: 'column', gap: '1rem' }}>

                    {/* Apply CTA */}
                    <div style={{ background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', padding: '1.5rem', textAlign: 'center' }}>
                        <p style={{ fontSize: '.875rem', color: '#515B6F', marginBottom: '1rem' }}>Interested in this position?</p>
                        <Link href={`/jobs/${job.id}/apply`}
                            style={{ display: 'block', background: '#4640DE', color: '#fff', fontWeight: 700, padding: '12px 24px', borderRadius: '0.375rem', textDecoration: 'none', fontSize: '.9375rem' }}>
                            Apply Now
                        </Link>
                    </div>

                    {/* Overview */}
                    <div style={{ background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', padding: '1.5rem' }}>
                        <h3 style={{ fontFamily: "'Clash Display',sans-serif", fontSize: '1rem', fontWeight: 700, color: '#25324B', marginBottom: '1rem', paddingBottom: '.75rem', borderBottom: '1px solid #D6DDEB' }}>
                            Job Overview
                        </h3>
                        <dl style={{ display: 'grid', gap: '0.875rem' }}>
                            {[
                                { label: 'Company',  value: job.company  },
                                { label: 'Location', value: job.location },
                                { label: 'Category', value: job.category },
                                { label: 'Job Type', value: job.type     },
                                { label: 'Posted',   value: postedDate   },
                            ].filter(r => r.value).map(row => (
                                <div key={row.label}>
                                    <dt style={{ fontSize: '.75rem', fontWeight: 600, color: '#7C8493', textTransform: 'uppercase', letterSpacing: '.05em', marginBottom: '.125rem' }}>{row.label}</dt>
                                    <dd style={{ fontSize: '.9375rem', color: '#25324B', fontWeight: 500 }}>{row.value}</dd>
                                </div>
                            ))}
                        </dl>
                    </div>

                    {/* Related jobs */}
                    {relatedJobs?.length > 0 && (
                        <div style={{ background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', padding: '1.5rem' }}>
                            <h3 style={{ fontFamily: "'Clash Display',sans-serif", fontSize: '1rem', fontWeight: 700, color: '#25324B', marginBottom: '1rem', paddingBottom: '.75rem', borderBottom: '1px solid #D6DDEB' }}>
                                Similar Jobs
                            </h3>
                            <div style={{ display: 'flex', flexDirection: 'column', gap: '.875rem' }}>
                                {relatedJobs.map(j => (
                                    <Link key={j.id} href={`/jobs/${j.id}`}
                                        style={{ display: 'flex', gap: '.75rem', textDecoration: 'none' }}>
                                        <div style={{ width: '2.5rem', height: '2.5rem', borderRadius: '0.375rem', background: '#EEF0FD', display: 'flex', alignItems: 'center', justifyContent: 'center', fontWeight: 700, color: '#4640DE', fontSize: '.75rem', flexShrink: 0 }}>
                                            {(j.company || '').slice(0, 2).toUpperCase()}
                                        </div>
                                        <div>
                                            <p style={{ fontWeight: 600, color: '#25324B', fontSize: '.875rem' }}>{j.title}</p>
                                            <p style={{ fontSize: '.8125rem', color: '#7C8493' }}>{j.company}</p>
                                        </div>
                                    </Link>
                                ))}
                            </div>
                        </div>
                    )}
                </aside>
            </div>
        </AppLayout>
    );
}
