import React from 'react';
import { Head, Link, useForm, router } from '@inertiajs/react';
import AdminLayout from '@/Layouts/AdminLayout';

const CATEGORIES = ['Technology', 'Design', 'Marketing', 'Finance', 'Healthcare', 'Education', 'Engineering', 'Sales'];
const JOB_TYPES  = ['Full-time', 'Part-time', 'Contract', 'Remote', 'Internship'];

function Field({ label, required, error, hint, children }) {
    return (
        <div style={{ marginBottom: '1.5rem' }}>
            <label style={{ display: 'block', fontSize: '.875rem', fontWeight: 600, color: '#25324B', marginBottom: '.375rem' }}>
                {label}{required && <span style={{ color: '#d32f2f' }}> *</span>}
            </label>
            {children}
            {hint  && <p style={{ fontSize: '.75rem', color: '#7C8493',  marginTop: '.25rem' }}>{hint}</p>}
            {error && <p style={{ fontSize: '.75rem', color: '#d32f2f', marginTop: '.25rem' }}>{error}</p>}
        </div>
    );
}

const inp = (err) => ({
    width: '100%', padding: '10px 14px', border: `1px solid ${err ? '#d32f2f' : '#D6DDEB'}`,
    borderRadius: '4px', fontSize: '.9375rem', color: '#25324B', outline: 'none',
    background: '#fff', boxSizing: 'border-box', fontFamily: 'inherit',
});

export default function AdminJobEdit({ job }) {
    const { data, setData, put, processing, errors } = useForm({
        title:       job.title       ?? '',
        company:     job.company     ?? '',
        location:    job.location    ?? '',
        category:    job.category    ?? '',
        type:        job.type        ?? '',
        description: job.description ?? '',
    });

    const submit = e => { e.preventDefault(); put(`/admin/jobs/${job.id}`); };

    const handleDelete = () => {
        if (confirm(`Delete "${job.title}"? This cannot be undone.`)) {
            router.delete(`/admin/jobs/${job.id}`);
        }
    };

    return (
        <AdminLayout>
            <Head title={`Edit – ${job.title}`} />

            <div style={{ marginBottom: '1.5rem', display: 'flex', alignItems: 'center', justifyContent: 'space-between', flexWrap: 'wrap', gap: '1rem' }}>
                <div style={{ display: 'flex', alignItems: 'center', gap: '1rem' }}>
                    <Link href="/admin/jobs" style={{ color: '#7C8493', textDecoration: 'none', fontSize: '.875rem' }}>← Back</Link>
                    <h1 style={{ fontFamily: "'Clash Display',sans-serif", fontSize: 'clamp(1.25rem,4vw,1.5rem)', fontWeight: 700, color: '#25324B' }}>Edit Job</h1>
                </div>
                <button onClick={handleDelete}
                    style={{ background: '#FFF2F2', color: '#d32f2f', fontWeight: 600, padding: '8px 16px', borderRadius: '0.375rem', border: '1px solid #ffc2c2', cursor: 'pointer', fontSize: '.875rem', fontFamily: 'inherit' }}>
                    Delete Job
                </button>
            </div>

            <div style={{ background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', padding: '2rem', maxWidth: '720px' }}>
                <form onSubmit={submit}>
                    <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit,minmax(280px,1fr))', gap: '0 1.5rem' }}>
                        <Field label="Job Title" required error={errors.title}>
                            <input value={data.title} onChange={e => setData('title', e.target.value)}
                                placeholder="e.g. Frontend Developer" style={inp(errors.title)} />
                        </Field>

                        <Field label="Company" required error={errors.company}>
                            <input value={data.company} onChange={e => setData('company', e.target.value)}
                                placeholder="e.g. Acme Corp" style={inp(errors.company)} />
                        </Field>

                        <Field label="Location" required error={errors.location}>
                            <input value={data.location} onChange={e => setData('location', e.target.value)}
                                placeholder="e.g. New York, NY or Remote" style={inp(errors.location)} />
                        </Field>

                        <Field label="Category" required error={errors.category}>
                            <select value={data.category} onChange={e => setData('category', e.target.value)} style={inp(errors.category)}>
                                <option value="">Select a category</option>
                                {CATEGORIES.map(c => <option key={c} value={c}>{c}</option>)}
                            </select>
                        </Field>

                        <Field label="Job Type" error={errors.type}>
                            <select value={data.type} onChange={e => setData('type', e.target.value)} style={inp(errors.type)}>
                                <option value="">Select type</option>
                                {JOB_TYPES.map(t => <option key={t} value={t}>{t}</option>)}
                            </select>
                        </Field>
                    </div>

                    <Field label="Job Description" required error={errors.description}
                        hint="Describe the role, responsibilities, and requirements.">
                        <textarea value={data.description} onChange={e => setData('description', e.target.value)}
                            rows={10} placeholder="Describe the role in detail..." style={{ ...inp(errors.description), resize: 'vertical' }} />
                    </Field>

                    <div style={{ display: 'flex', gap: '1rem', paddingTop: '0.5rem' }}>
                        <button type="submit" disabled={processing}
                            style={{ background: '#4640DE', color: '#fff', fontWeight: 700, padding: '11px 28px', borderRadius: '0.375rem', border: 'none', cursor: processing ? 'not-allowed' : 'pointer', opacity: processing ? .7 : 1, fontSize: '.9375rem' }}>
                            {processing ? 'Saving…' : 'Save Changes'}
                        </button>
                        <Link href={`/jobs/${job.id}`}
                            style={{ padding: '11px 24px', borderRadius: '0.375rem', border: '1px solid #D6DDEB', color: '#515B6F', textDecoration: 'none', fontWeight: 600, fontSize: '.9375rem' }}>
                            Preview
                        </Link>
                    </div>
                </form>
            </div>
        </AdminLayout>
    );
}
